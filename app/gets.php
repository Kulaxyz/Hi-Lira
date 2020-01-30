<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class gets extends Model
{
    public static function create($wallet){
    	$ammount = DB::table('wallets')->where('wallet', Auth::user()->wallet)->first();

        $ammount = $ammount->balance;
    	static::insert([
    		'wallet'  =>$wallet ,
    		'user_id' =>Auth::user()->id,
    		'ammount' => $ammount,
    		'created_at' => new \DateTime()
    	]);
    }
}
