<?php

namespace App\Http\Controllers;

use App\Console\Commands\IncreaseBalance;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;

class PaymentController extends Controller
{
    const EXCHANGE_API_LINK = 'https://api.exchangeratesapi.io/latest';
    const MODULE_BANK_LINK = 'https://apismsgo.ru/bot_modulebank_payment.php';
    const MODULE_COMPLETE_STATUS = 'COMPLETE';
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// UnitPay: afterparty

    public function unitpay_result(Request $req){
        if (!$req->unitpay_after_party) { return '505: Internal error. Please reload the page...'; }
        else
            {
                $user = DB::table('users')->where('phone', $req->phone)->first();
                $userpay = Payment::UserPay($user->id, $req->sum);
                $save_to_base = Payment::save_to_base_unitpay($user->id, $req->sum, $req->success);
                return $userpay."_".$save_to_base;
            }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Stripe Credit Card

    // this method is for Stripe payments
    public function stripe_card(Request $post){
        if(!$post) {return abort(404);}
        return view('payment-stripe', ['debug' => $post]);
    }
    public function stripe_card_test(){
        return view('payment-stripe');
    }
    public function apple_stripe_card_test(){
        return view('payment-apple');
    }

    // this method is for printing Stripe payment result page
    public function stripe_result(Request $get){
        if(!$get) {return abort(404);}
        return view('stripe-result', ['debug' => $get]);
    }

    // this method is for printing Stripe payment result page, when you hit it around the rules
    public function stripe_res_get(Request $post){
        return abort(404);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ApplePay

    // this method is for Apple payments (Stripe)
    public function apple_pay(Request $post){
        if(!$post) {return abort(404);}
        return view('payment-apple', ['debug' => $post]);
    }

    // this method is for handling a request from applepay
    public function apple_pay_result(Request $post){
        if(!$post) {return abort(404);}
        return view('apple-pay-result', ['debug' => $post]);
    }

    // this method is for printing payment result page, when you hit it around the rules
    public function apple_pay_get(Request $post){
        return abort(404);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Cryptos and older stuff...

    public function card(Request $post)
    {
        $val = Payment::create($post->all()['value'], $post->all()['type']);

        $resp = Payment::getStatus($val);

        if(!isset($resp))
            return abort(404);

        if(Auth::user()->id != $resp['user_id'] && Auth::user()->role_id != 1){
            return abort(404);
        }

        return view('payment-visa', ['usd' => $post['value'], 'ammount'=> $resp['ammout_remain'], 'address'=>$resp['address'], 'debug' => $resp]);

    }

    public function payModuleBank(Request $request)
    {
        $rates = file_get_contents(self::EXCHANGE_API_LINK);
        $rates = json_decode($rates, true)['rates'];
        $curr_coef = round($rates['RUB'] / $rates['TRY'], 2);

        $amount_in_TRY = $request->post('num');
        $amount_in_RUB = $amount_in_TRY * $curr_coef;
        $payment = new Payment;
        $payment->user_id = auth()->id();
        $payment->type = 'in';
        $payment->amount = $amount_in_TRY;
        $payment->amount_remain = $amount_in_RUB;
        $payment->status = 0;//WAITING
        $payment->address = 'ModuleBank';
        $payment->save();

        $link = self::MODULE_BANK_LINK.'?oa='.$amount_in_RUB.'&o='.$payment->id;

        return redirect()->to($link);
    }

    public function moduleStatus(Request $request)
    {
        if ($request->state == self::MODULE_COMPLETE_STATUS) {
            if ($request->testing != 1 && isset($request->custom_order_id)) {
                $payment = Payment::findOrFail($request->custom_order_id);
                if ($payment->status == 0) {//WAITING
                    $user = User::findOrFail($payment->user_id);
                    $payment->status = 1;
                    $payment->succes = 1;
                    $payment->save();
                    $user->balance += $payment->amount;
                    $user->save();

                    IncreaseBalance::increaseBalance($user, $user->daily_coef);

                    if ($user->referal) {
                        $ref = User::where('wallet', $user->referal)->first();
                        $bonus = $payment->amount * (User::REF_BONUS/100);
                        $ref->balance += $bonus;
                        $ref->tokens += $bonus;
                        $ref->save();
                    }
                }
            }
        }
        die('200  OK');
    }

    public function get(Request $post)
    {

        if(!($post->all()['value'] >= 1 && $post->all()['value'] <=100000) || !is_numeric($post->all()['value']) ) { return abort(500); }

        $rates = Payment::rates();

        $usd = $rates['result']['USD']['rate_btc'];
        $bch = $rates['result']['BCH']['rate_btc'];
        $eth = $rates['result']['ETH']['rate_btc'];
        $ltc = $rates['result']['LTC']['rate_btc'];

        $btc = 1/$usd;

        $BTC = (($post->all()['value'])/$btc);

        $BCH = $BTC *(1/ $bch);
        $ETH = $BTC *(1/ $eth);
        $LTC = $BTC *(1/ $ltc);

        $amount = $post->all()['value'];
        $url = 'simplexxx-pro.herokuapp.com/?sum='.$amount.'&w=1HqQxU79rrVDVAMirzG3QPEFk7UVVh9nwA';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $form = curl_exec($ch);
        curl_close($ch);

        return view('methods',
            [
                'debug' => $post,
                'form' => $form,
                'ammount'=> $amount,
                'btc'=>$BTC,
                'bch'=>$BCH,
                'eth'=>$ETH,
                'ltc'=>$LTC
            ]);
    }


    // this method gets a POST from methods-page and redirects the journey to the payStatus method (below)
     public function pay(Request $post)
    {
        $id = Payment::create($post->all()['value'], $post->all()['type']);
        return redirect()->route('payStatus', ['{txt_id}' => $id]);
    }


    // this method displays a page with QR-code
    public function payStatus($val){

        $resp = Payment::getStatus($val);
        if(!isset($resp))
            return abort(404);

        if(Auth::user()->id != $resp['user_id'] && Auth::user()->role_id != 1){
            return abort(404);
        }
        $timeLeft = strtotime($resp['created_at']) + $resp['timeout']-time();
        if($timeLeft < 0)
            $timeLeft = 0;
        return view('payment', [
            'qr'=> $resp['qr_link'],
            'ammount'=> $resp['ammout_remain'],
            'address'=> $resp['address'],
            'timeout'=> $timeLeft,
            'type'=> $resp['curency'],
            'status_text'=> $resp['status_text'],
            'debug' => $resp
            ]
         );

    }

    // this method displays a status page for payments which do not require further and post-actions
    public function payStatus_2(){
        return view('status-result');
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */

    // public function show($payment)
    // {
    //     // pay($ammount)
    // {

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Payment  $payment
    //   pay($ammount)
    // {* @return \Illuminate\Http\Response
    //  */
    // public function edit(Payment $payment)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request pay($ammount)
    {
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

}
