<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PushNotificationController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @return void
     */
    public function saveDeviceToken(Request $request)
    {
        try {
            DB::table('push_notification_device')->where('device_key',$request->token)->delete();
            if(Auth::check()){
                DB::table('push_notification_device')->where('user_id',Auth::user()->id)->delete();
            }
            DB::table('push_notification_device')->insert([
                'device_key'=>$request->token,
                'user_id' => Auth::user()->id ?? NULL,
                'created_at' => date("Y-m-d h:i:s", time())
            ]);
            // session(['fcm_token' => $request->token]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
        return true;
    }
}
