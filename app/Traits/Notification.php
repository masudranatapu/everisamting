<?php
namespace App\Traits;
use App\Models\PushNotification;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Modules\PushNotification\Entities\UserDeviceToken;

trait Notification {

    public function sendNotification($encodedData)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = [
            // 'Authorization: key=' . env('FIREBASE_SERVER_KEY'),
            'Authorization: key=' . 'AAAAVHI5lYo:APA91bF7Hj0u2HiiJkV6KQrUUqUSPu8Jt1wpLQipElFGkhB-OwG4Oqncwmlxu_c8VxvNXu0m6Bld74aa_kGPNA3YsM6a7HFCGLqBq4cXydjKf2JaQ70ZVqrgECsjUdCtMnS-E5QgK_Gj',
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        $notification_res = json_decode($result, TRUE);
        return $notification_res;
    }


    public function sendUserNotification($user_id,$title,$body,$action)
    {

        $settings = Setting::first();
        $notification_res = [];
        $devices      = UserDeviceToken::where('user_id',$user_id)
                    ->whereNotNull('device_token')
                    ->pluck('device_token')
                    ->all();
        if($devices){
            $data = [
                "registration_ids" => $devices,
                "notification"  => [
                    "title"     => $title,
                    "body"      => $body,
                    'image'     => NULL,
                    'icon'      => asset($settings->favicon_image),
                    'click_action' => $action ?? url('/'),
                ],
                'priority'     => 'high',
                'openURL'      => $action ?? url('/')
            ];
        $encodedData = json_encode($data);
        $notification_res = $this->sendNotification($encodedData);
        }

        if($notification_res){
            if(!empty($notification_res['results']['0']['message_id'])){
                $message_id       = $notification_res['results']['0']['message_id'];
            }
        }
        return $notification_res;
    }




    public function sendAdminNotification($title,$body,$action)
    {
        $notification           = new PushNotification();
        $notification->title    = $title;
        $notification->body     = $body;
        $notification->image    = NULL;
        $notification->click_action = $action ?? url('/');
        $notification->type     = 'web';
        $notification->status   = 1;
        $notification->save();

        $settings = settings();
        $notification_res = [];
        $devices      = DB::table('push_notification_device')
        ->leftJoin('users','users.id','=','push_notification_device.user_id')
        // ->where('users.user_type','=','admin')
        ->whereNotNull('device_key')->pluck('device_key')->all();
        if($devices){
            $data = [
                "registration_ids" => $devices,
                "notification"  => [
                    "title"     => $title,
                    "body"      => $body,
                    'image'     => NULL,
                    'icon'      => asset($settings->application_logo),
                    'click_action' => $action ?? url('/')
                ],
                'priority'     => 'high',
                'openURL'      => $action ?? url('/')
            ];
        $encodedData = json_encode($data);
        $notification_res = $this->sendNotification($encodedData);
        }
        if($notification_res){
            if(!empty($notification_res['results']['0']['message_id'])){
                $message_id       = $notification_res['results']['0']['message_id'];
            }
        }
        return $notification_res;
    }

}
