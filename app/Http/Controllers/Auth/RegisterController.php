<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function register(Request $request)
    {
        if ($this->validator($request->all())->fails()) {
            $errors = $this->validator($request->all())->errors()->getMessages();
            $clientErrors = array();
            foreach ($errors as $key => $value) {
                $clientErrors[$key] = $value[0];
            }
            $response = array(
                'status' => 'error',
                'response_code' => 400,
                'errors' => $clientErrors
            );
        } else {
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
            $this->guard()->login($user);

            $response = array(
                'status' => 'success',
                'response_code' => 200
            );
        }
        echo json_encode($response);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:2', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $referal = null;
        if(isset($_COOKIE['referal_id']) && User::where('wallet', '=',$_COOKIE['referal_id'])->exists()){
            $referal = $_COOKIE['referal_id'];
            //User::where('wallet', $_COOKIE['referal_id'])->update(['tokens' => DB::raw('tokens + 100')]);
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'wallet' => \App\sign::generateSecureToken(22),
            'referal' => $referal,
            'daily_coef' => 0.5,
            'balance' => 5,
        ]);
    }
}
