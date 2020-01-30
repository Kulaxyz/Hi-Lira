<?php

namespace App\Http\Controllers;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Payment;
class HomeController extends Controller
{
    const MINUTES_IN_DAY = 1440;
    const DEFAULT_DAILY_COEF = 0.5;
    const SECONDS_TO_UPDATE_BALANCE = 10;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function gets(Request $post){
        \App\gets::create($post->all()['wallet']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return redirect(route('index'));
    // }
    public function wallet()
    {
        $time = time() - strtotime(Auth::user()->created_at);
        $user = Auth::user();
//        $transactions = DB::table('payments')->where('user_id',Auth::user()->id)->get()->reverse()->values();
        $transactions = Payment::where('user_id', Auth::id())->where('succes', 1)->get();
        $referals = User::where('referal', Auth::user()->wallet);
        $total = $referals->count();
        $activeAffiliates = $referals->where('balance', '>', 0)->count();
        $inactiveAffiliates = $total - $activeAffiliates;

        $balance = $this->get_balance();

        return view('wallet',
            ['wallet'=>$user->wallet,
                'balance'=>$balance,
                'transactions' => $transactions,
                'total' => $total,
                'activeAffiliates' => $activeAffiliates,
                'inactiveAffiliates' => $inactiveAffiliates,
                'profit' => $user->tokens
            ]);
    }

    public function invest()
    {
        return view('invest');
    }

    public function withdrawal()
    {
        $balance = $this->get_balance();
        return view('withdrawal', compact('balance'));
    }

    public function withdrawalMake(Request $request)
    {
        $amount = $request->post('amount');

        if ($amount > auth()->user()->balance) {
            return redirect()->back()->with(['errors' => ['Yeterli Para Yok!']]);
        }
        $payment = new Payment;
        $payment->user_id = auth()->id();
        $payment->type = 'out';
        $payment->amount = $amount;
        $payment->status = 0;//WAITING
        $payment->save();

        auth()->user()->balance -= $amount;
        auth()->user()->save();

        return redirect()->to(route('history'));
    }

    public function history(){
        //$transactions = \App\Payment::select('*')->where(['user_id' => Auth::user()->id])->get()->values();
        $transactions = Payment::where('user_id',Auth::user()->id)->get()->reverse()->values();
        return view('history', ['transactions'=> $transactions]);
    }

    public function referral()
    {
        $amount = auth()->user()->tokens;
        $refs = User::where('referal', Auth::user()->wallet);
        $count = $refs->count();
        $active = $refs->where('balance', '>', 0)->count();

        return view('invite', compact('amount', 'count', 'active'));
    }

    public function coefs()
    {
        if (auth()->user()->role_id != 1) {
            abort(403);
        }
        $min = Setting::where('key', 'min_coef')->first()->value;
        $max = Setting::where('key', 'max_coef')->first()->value;

        return view('coefs', compact('min', 'max'));
    }

    public function coefsUpdate(Request $request)
    {
        if (auth()->user()->role_id != 1) {
            abort(403);
        }

        if ($request->post('min_coef') && $request->post('max_coef')) {
            $min = Setting::where('key', 'min_coef')->first();
            $max = Setting::where('key', 'max_coef')->first();
            $min->value = $request->post('min_coef');
            $max->value = $request->post('max_coef');

            $min->save();
            $max->save();
            return redirect()->back();
        } else {
            return redirect()->back()->with(['errors' => 'Max and min values are required']);
        }
    }

    public function get_balance()
    {
        $user = auth()->user();
        $balance =  $user->balance;
        $bonus = $balance - (100 * $user->balance) / (100 + $user->daily_coef);
        $balance -= $bonus;

        $diffInSeconds = Carbon::now()->diffInSeconds(Carbon::now()->startOfDay());
        $partOfBonus = $bonus / (self::MINUTES_IN_DAY * (60/self::SECONDS_TO_UPDATE_BALANCE));

        $time_diff = floor($diffInSeconds / self::SECONDS_TO_UPDATE_BALANCE);

        $balance += $partOfBonus * $time_diff;

        return $balance;
    }

}
