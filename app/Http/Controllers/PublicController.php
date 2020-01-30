<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Payment;
class PublicController extends Controller
{
    public function privacy()
    {
        return view('privacy');
    }
    public function callback(Request $post){
        //$filename = '/opt/libra/storage/logs/payment-'.$today = date("Y-m-d").'.log';
        //$data = json_encode($post->all()).PHP_EOL;
        //file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
        Payment::callback($post->all());
    }
    public function referalRegister($wallet){
        setcookie('referal_id', $wallet, 0,  "/");
        return redirect(route('index'));
    }
    public function index()
    {
        return view('index');
    }
    public function paper()
    {
        return view('paper');
    }
    public function learn()
    {
        return view('learn');
    }
    public function media()
    {
        return view('media');
    }
    public function viber_test(Request $post)
    {
        return view('viber', ['debug' => $post]);
    }
    public function rules()
    {
        return view('rules');
    }

    public function team()
    {
        return view('team');
    }

    public function tech()
    {
        return view('tech');
    }

}
