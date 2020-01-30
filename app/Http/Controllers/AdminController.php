<?php

namespace App\Http\Controllers;

use App\APIKeys;
use App\Payment;
use Illuminate\Http\Request;
use Auth;
use DB;

class AdminController extends Controller
{

    public function apiKeys()
    {
        $constants = APIKeys::all();
        return view('api_keys', compact('constants'));
    }

    public function saveKeys(Request $request)
    {
        $api_key = APIKeys::where('key', $request->post('key'))->first();
        $api_key->value = $request->post('value');
        $api_key->save();

        return redirect()->back();
    }

    public function info_user($number)
    {
        if ( (Auth::user()) && (Auth::user()->role_id == 1) )
        {
            $user = DB::table('users')->where('phone', $number)->first();
            $user->password = "******";
            $user->remember_token = "******";
            
            return json_encode($user);
        }
        else
        {
            return abort(404);
        }
    }

    public function delete_user($number)
    {
        if ( (Auth::user()) && (Auth::user()->role_id == 1) )
        {
            if ( DB::table('users')->where('phone', $number)->delete() )
                {
                    $response = array('success' => true, 'deleted' => $number);
                    return json_encode($response);
                }
            else
                {
                    $response = array('success' => false, 'deleted' => 'none');
                    return json_encode($response);
                }
        }
        else
        {
            return abort(404);
        }
    }

    public function make_admin($number)
    {
        $response['status'] = false;

        if ( (Auth::user()) && (Auth::user()->role_id == 1))
            {
                $user = DB::table('users')->where('phone', $number)->update(['role_id' => 1]);
                if ( $user != 0 )
                    {
                        $response['status'] = 'ok';
                        $response['message'] = $number.'_is_admin_now';
                    }
                else
                    {
                        $response['message'] = 'false:_'.$user;
                    }
            }
        else
            {
                $response['message'] = 'Unauthorized_person_must_log_in';
            }

        return json_encode($response);
    }

    public function unmake_admin($number)
    {
        $response['status'] = false;

        if ( (Auth::user()) && (Auth::user()->role_id == 1))
            {
                $user = DB::table('users')->where('phone', $number)->update(['role_id' => 2]);
                if ( $user != 0 )
                    {
                        $response['status'] = 'ok';
                        $response['message'] = $number.'_is_admin_now';
                    }
                else
                    {
                        $response['message'] = 'false:_'.$user;
                    }
            }
        else
            {
                $response['message'] = 'Unauthorized_person_must_log_in';
            }

        return json_encode($response);
    }

// closing bracket of the class
}