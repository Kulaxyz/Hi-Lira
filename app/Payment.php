<?php

namespace App;
use Auth;
//use Illuminate\Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{

	public static function rates()
	{

		$public_key = APIKeys::where('key', 'COINPAYMENTS_PUBLIC_KEY')->first()->value;

		$private_key =  APIKeys::where('key', 'COINPAYMENTS_PRIVATE_KEY')->first()->value;

	    // Set the API command and required fields
	    $req['version'] = 1;
	    $req['cmd'] = 'rates';
	    $req['accepted'] = 1;
	    $req['key'] = $public_key;
	    $req['format'] = 'json'; //supported values are json and xml

	    // Generate the query string
	    $post_data = http_build_query($req, '', '&');
	    // Calculate the HMAC signature on the POST data
        $hmac = hash_hmac('sha512', $post_data, $private_key);

        // Create cURL handle and initialize (if needed)
	    static $ch = NULL;
	    if ($ch === NULL) {
	        $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // Execute the call and close cURL handle
        $data = curl_exec($ch);

        // Parse and return data if successful.
	    if ($data !== FALSE) {
	        if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
	            // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
	            $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
	        } else {
	            $dec = json_decode($data, TRUE);
	        }
	        if ($dec !== NULL && count($dec)) {
	            return $dec;
	        } else {
	            // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
	            return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
	        }
	    } else {
	        return array('error' => 'cURL error: '.curl_error($ch));
	    }

	}

	public static function create($ammount, $curr)
	{
		$curr = mb_strtoupper($curr);
        $public_key = APIKeys::where('key', 'COINPAYMENTS_PUBLIC_KEY')->first()->value;

        $private_key =  APIKeys::where('key', 'COINPAYMENTS_PRIVATE_KEY')->first()->value;

	    // Set the API command and required fields
	    $req['item_number'] = Auth::user()->id;
	    $req['version'] = 1;
	    $req['cmd'] = 'create_transaction';
	    $req['amount'] = $ammount;
	    $req['currency1']= 'USD';
	    $req['currency2']= $curr;
	    //$req['buyer_name'] = Auth::user()->name.':'.Auth::user()->id;
	    //$req['buyer_email'] = Auth::user()->email;
	    $req['key'] = $public_key;

	    $req['format'] = 'json'; //supported values are json and xml

	    // Generate the query string
	    $post_data = http_build_query($req, '', '&');

	    // Calculate the HMAC signature on the POST data
	    $hmac = hash_hmac('sha512', $post_data, $private_key);

	    // Create cURL handle and initialize (if needed)
	    static $ch = NULL;
	    if ($ch === NULL) {
	        $ch = curl_init('https://www.coinpayments.net/api.php');
	        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    }
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

	    // Execute the call and close cURL handle
	    $data = curl_exec($ch);
	    // Parse and return data if successful.
	    if ($data !== FALSE) {
	        if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
	            // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
	            $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
	        } else {
	            $dec = json_decode($data, TRUE);
	        }
	        if ($dec !== NULL && count($dec)) {
				Payment::save_to_base($req, $dec);
	            return $dec['result']['txn_id'];
	        } else {
	            // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
	            return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
	        }
	    } else {
	        return array('error' => 'cURL error: '.curl_error($ch));
	    }

	}

	public static function save_to_base($req, $dec){
		$srv = $dec['result'];

		static::insert([
			"user_id" => Auth::user()->id,
			// "user_username" => $req['buyer_name'],
			// "user_email" => $req['buyer_email'],
			"type"=>"crypto",
			"address" => $srv['address'],
			"ammount" => $srv['amount'],
			"ammout_remain" => $srv['amount'],
			"ammount_usd" => $req['amount'],
			"curency" => $req['currency2'],
			"status" => 0,
			"succes" => 0,
			"txn_id" => $srv['txn_id'],
			"status_link" => $srv['status_url'],
			"qr_link" => $srv['qrcode_url'],
			"timeout" => $srv['timeout'],
			"created_at" => new \DateTime()
		]);

	}

	public static function getStatus($txn_id)
    {
		$resp = static::where('txn_id', $txn_id)->get();
		if(count($resp) == 0)
			return null;
		User::where('wallet', Auth::user()->referal)->update(['balance' => DB::raw('balance + 0')]);

		return $resp[0]->attributes;
	}

	public static function callback($post){

		$status = $post['status'];

		if($status == 0){ 									//Initialization wallet

		} else if($status == -1){							// Cancelled

			$pay = static::where('txn_id', $post['txn_id'])
				->update([
					'status'		=>	-1,
					'status_text'	=>	$post['status_text'],
					'updated_at'	=> 	new \DateTime()
				]);

		} else if($status == 2){ 								// Part of money

			$ammount_left = Payment::GetAmmoutLeft($post['address']);

			$pay = static::where(['address', $post['address']])
				->update([
					'status'		=>	2,
					'updated_at'	=> 	new \DateTime(),
					'ammout_remain' => $ammount_left - $post['amount']

				]);

		} else if($status >= 100) {								//Succes


			if(static::where([
				['txn_id', '=', $post['txn_id']],
				['succes', '=', 0]
				])->exists())
			Payment::UserPay($post['item_number'], $post['amount1']);
			static::where([

				['txn_id', '=', $post['txn_id']],
				['succes', '=', 0]
				])
			->update([
					'status'		=>	100,
					'status_text'	=>	$post['status_text'],
					'succes'		=>	1,
					'updated_at'	=> 	new \DateTime()
				]);
		}

	}
	static function UserPay($userid, $usd){
		    $coins = $usd;
			$bonus = 0;
//            if ($usd < 100) {
//                $bonus = 0;
//            }
//            if (($usd >= 100) && ($usd < 500)) {
//                $bonus = round($coins * 0.01);
//            }
//            if (($usd >= 500) && ($usd < 1000)) {
//                $bonus = round($coins * 0.025);
//            }
//            if ($usd >= 1000) {
//                $bonus = round($coins * 0.05);
//            }
//            $coins += $bonus;

		DB::table('users')
            ->where('id', $userid)
            ->update(['balance' =>DB::raw('balance + '. $usd)]);

        $user = DB::table('users')
			->where('id', $userid)
			->first();

		DB::table('wallets')
			->where(['wallet'=> $user->wallet])
			->update(['balance' => DB::raw('balance + '.$coins)]);

		//////////////////////////////////////////////////////////////////////
		// referal bonus script
        if(isset($user->referal))
        {
        	// the referal bonus in percents of the usd-sum payed by customer
        	$referal_bonus = config('constants.referal_bonus');

        	DB::table('users')
     			->where(['wallet'=> $user->referal])
     			->update([
     			    'tokens' => DB::raw('tokens + '. ($usd*$referal_bonus)),
                    'balance' => DB::raw('balance + '. ($usd*$referal_bonus)),
                    ]);
     	}

		return 'UserPay';
    }

    static function GetAmmoutLeft($address){
    	return DB::select('Select ammout_remain from payments where address = "'.$address.'"')[0]->ammout_remain;
    }

    public static function SetClass(){

    	$user = Auth::user();

		$first = DB::table('payments')
			->where(['user_id'=> $user->id])
			->first();

		if ($first)
			{return 'usual_class';}
		else
			{return 'disabled';}

    }

    public static function SetAction(){

    	$user = Auth::user();

		$first = DB::table('payments')
			->where(['user_id'=> $user->id])
			->first();

		if ($first)
			{return '';}
		else
			{return 'say(event);';}

    }

    public static function save_to_base_stripe($user_id, $amount_usd, $success){

    	if ($success == 1)
	    	{
				static::insert([

					"user_id" => $user_id,
					// "user_username" => $req['buyer_name'],
					// "user_email" => $req['buyer_email'],
					"address" => 'not_applied',
					"type"=>'card',
					"ammount" => $amount_usd,
					"ammout_remain" => $amount_usd,
					"ammount_usd" => $amount_usd,
					"curency" => 'USD',
					"status" => 100,
					"status_text" => 'Complete',
					"succes" => 1,
					"txn_id" => 'not_applied',
					"qr_link" => 'not_applied',
					"status_link" => 'not_applied',
					"timeout" => 0,
					"created_at" => new \DateTime()

				]);
			}
	elseif ($success == 0)
		{
			static::insert([

				"user_id" => $user_id,
				// "user_username" => $req['buyer_name'],
				// "user_email" => $req['buyer_email'],
				"address" => 'not_applied',
				"type"=>'card',
				"ammount" => $amount_usd,
				"ammout_remain" => $amount_usd,
				"ammount_usd" => $amount_usd,
				"curency" => 'USD',
				"status" => '-1',
				"status_text" => 'Cancelled / Timed Out',
				"succes" => 0,
				"txn_id" => 'not_applied',
				"qr_link" => 'not_applied',
				"status_link" => 'not_applied',
				"timeout" => 0,
				"created_at" => new \DateTime()

			]);
		}


	}

    public static function save_to_base_apple($user_id, $amount_usd, $success){

    	if ($success == 1)
	    	{
				static::insert([

					"user_id" => $user_id,
					// "user_username" => $req['buyer_name'],
					// "user_email" => $req['buyer_email'],
					"address" => 'not_applied',
					"type"=>'a-g-m-card',
					"ammount" => $amount_usd,
					"ammout_remain" => $amount_usd,
					"ammount_usd" => $amount_usd,
					"curency" => 'USD',
					"status" => 100,
					"status_text" => 'Complete',
					"succes" => 1,
					"txn_id" => 'not_applied',
					"qr_link" => 'not_applied',
					"status_link" => 'not_applied',
					"timeout" => 0,
					"created_at" => new \DateTime()

				]);
			}
	elseif ($success == 0)
		{
			static::insert([

				"user_id" => $user_id,
				"address" => 'not_applied',
				"type"=>'a-g-m-card',
				"ammount" => $amount_usd,
				"ammout_remain" => $amount_usd,
				"ammount_usd" => $amount_usd,
				"curency" => 'USD',
				"status" => '-1',
				"status_text" => 'Cancelled / Timed Out',
				"succes" => 0,
				"txn_id" => 'not_applied',
				"qr_link" => 'not_applied',
				"status_link" => 'not_applied',
				"timeout" => 0,
				"created_at" => new \DateTime()

			]);
		}

	}

	public static function save_to_base_unitpay($user_id, $amount_usd, $success){

    	if ($success == 1)
	    	{
				static::insert([

					"user_id" => $user_id,
					"address" => 'not_applied',
					"type"=>'unitpay',
					"ammount" => $amount_usd,
					"ammout_remain" => $amount_usd,
					"ammount_usd" => $amount_usd,
					"curency" => 'USD',
					"status" => 100,
					"status_text" => 'Complete',
					"succes" => 1,
					"txn_id" => 'not_applied',
					"qr_link" => 'not_applied',
					"status_link" => 'not_applied',
					"timeout" => 0,
					"created_at" => new \DateTime()

				]);
			}
	elseif ($success == 0)
		{
			static::insert([

				"user_id" => $user_id,
				"address" => 'not_applied',
				"type"=>'unitpay',
				"ammount" => $amount_usd,
				"ammout_remain" => $amount_usd,
				"ammount_usd" => $amount_usd,
				"curency" => 'USD',
				"status" => '-1',
				"status_text" => 'Cancelled / Timed Out',
				"succes" => 0,
				"txn_id" => 'not_applied',
				"qr_link" => 'not_applied',
				"status_link" => 'not_applied',
				"timeout" => 0,
				"created_at" => new \DateTime()

			]);
		}
	return "save_to_base";
	}

//////////////////////////////////////////////////////////////////////
}


?>
