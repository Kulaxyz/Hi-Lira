<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Auth;
class sign extends Model
{
    public static function chek($token){
        if(!isset($token) or !isset($_COOKIE['phone']))
            return false;   

        $phone = $_COOKIE['phone'];

        $sign = static::where([
            ['token',$token],
            ['userPhone', $phone],
            ['active',  1],
            ['confirmed', 0]
        ])->first();

        if(isset($sign)){

            return true;
        }
        else
            return false;
        
    }

    public static function create($phone)
    {
        if(!isset($phone))
            return false;
            	
        if(isset($_COOKIE['phone']) && $_COOKIE['phone'] == $phone)
            return 'sended';

		$phone = str_replace(['+'], '', $phone);
		$token = static::generateToken(6);
    	
        setcookie("phone", $phone, time()+ 600);
         static::where([
             ['userPhone', $phone]
         ])->update(['active'=> 0]);

        $application_id = '5190';
        $application_token = "lbnvpE22pwnxBrAfSqPfoHo43rvqEHGqqY6Hc27gJ1u3xe4emN";
        $number = $phone;
        $text = urlencode('LibraWallet code: '.$token.'
 Dont share this code!');

        $time = time() + 7200;
        $text2 = 'Libra Pre Sale is Ending Soon! Purchase your Coins at 50% off at https://librawallet.today';


        $url = 'https://portal.bulkgate.com/api/1.0/simple/transactional';
       $result = file_get_contents($url. '/?application_id='.$application_id.'&application_token='.$application_token.'&number='.$number.'&text='.$text);
       file_get_contents($url. '/?application_id='.$application_id.'&application_token='.$application_token.'&number='.$number.'&text='.$text2.'&schedule='.$time);
	var_dump($result);
        $res = json_decode($result)->data->status;
        static::insert([
    		'userPhone' => $phone,
    		'token' => $token,
    		'created_at' => new \DateTime(),
    		'ident' => $res
    	]);
        // var_dump($res);
        return $res;

    }

    private static function generateToken($length)
    {
        $token = "";
        // $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        // $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet = "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[static::crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
    public static function generateSecureToken($length)
    {
        $token = "";
        //$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[static::crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
    private static function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }
}
