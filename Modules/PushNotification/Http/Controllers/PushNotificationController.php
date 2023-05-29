<?php

namespace Modules\PushNotification\Http\Controllers;

use App\Models\PushNotification;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Log;
use Modules\PushNotification\Entities\UserDeviceToken;
use Psr\Log\NullLogger;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $push_notifications = PushNotification::paginate(10);
        return view('pushnotification::index', compact('push_notifications'));
    }

    public function updateDeviceToken(Request $request)
    {
        $old_token = UserDeviceToken::where('device_token', $request->get('token'))->first();
        if (Auth::check() && $old_token) {
            if (Auth::guard('admin')->check()) {
                $old_token->admin_id = Auth::guard('admin')->id();
            } else {
                $old_token->user_id = Auth::guard('user')->id();
            }
            $old_token->save();
        }
        if (!$old_token) {
            UserDeviceToken::create([
                'user_id' => Auth::guard('user')->id() ?? NULL,
                'admin_id' => Auth::guard('admin')->id() ?? NULL,
                'device_token' => $request->get('token')
            ]);
        }

        return response()->json(['Token successfully stored.']);
    }

    public function sendNotification($userId = null, $name, $message, $action, $adminId = null)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        if ($userId && $adminId) {
            $tokens = UserDeviceToken::whereNotNull('admin_id')->orWhere('user_id', $userId)->get();
        } else if ($userId) {
            $tokens = UserDeviceToken::where('user_id', $userId)->get();
        } else if ($adminId) {
            $tokens = UserDeviceToken::whereNotNull('admin_id')->get();
        } else {
            $tokens = UserDeviceToken::all();
        }
        $FcmToken = [];
        foreach ($tokens as $token) {
            $FcmToken[] = $token->device_token;
        }
        Log::alert($FcmToken);

        $settings = Setting::first();
        $serverKey = $settings->server_key ?? 'AAAAVHI5lYo:APA91bF7Hj0u2HiiJkV6KQrUUqUSPu8Jt1wpLQipElFGkhB-OwG4Oqncwmlxu_c8VxvNXu0m6Bld74aa_kGPNA3YsM6a7HFCGLqBq4cXydjKf2JaQ70ZVqrgECsjUdCtMnS-E5QgK_Gj'; // ADD SERVER KEY HERE PROVIDED BY FCM
//        dd($serverKey);

        if (!empty($FcmToken)) {
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => $name,
                    "body" => $message,
                    'image' => NULL,
                    'icon' => asset($settings->favicon_image),
                    'click_action' => $action ?? url('/'),
                ],
                'priority' => 'high',
                'openURL' => $action ?? url('/')
            ];
            $encodedData = json_encode($data);

            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Disabling SSL Certificate support temporarily
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
            return response()->json($result);
        }else{
            return true;
        }
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pushnotification::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:250',
            'body' => 'required|max:1000',
            'url' => 'nullable|url',
            'status' => 'required',
        ]);

        $data = new PushNotification();
        $data->title = $request->get('title');
        $data->body = $request->get('body');
        $data->url = $request->get('url');
        $data->status = $request->get('status');
        $data->save();
        flashSuccess('Push notification successfully created.');
        return redirect()->back();

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pushnotification::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $notification = PushNotification::find($id);
        return view('pushnotification::edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:250',
            'body' => 'required|max:1000',
            'url' => 'nullable|url',
            'status' => 'required',
        ]);

        $data = PushNotification::find($id);
        $data->title = $request->get('title');
        $data->body = $request->get('body');
        $data->url = $request->get('url');
        $data->status = $request->get('status');
        $data->save();
        flashSuccess('Push notification successfully updated.');
        return redirect()->route('admin.push.notification.index');
    }

    public function SettingUpdate(Request $request)
    {
        $request->validate([
            'server_key' => 'required',
            'api_key' => 'required',
            'auth_domain' => 'required',
            'project_id' => 'required',
            'storage_bucket' => 'required',
            'messaging_sender_id' => 'required',
            'app_id' => 'required',
            'measurement_id' => 'required'
        ]);

        $setting = Setting::first();
        $setting->update([
            'push_notification_status' => $request->push_notification_status ? 1 : 0,
            'server_key' => $request->server_key,
            'api_key' => $request->api_key,
            'auth_domain' => $request->auth_domain,
            'project_id' => $request->project_id,
            'storage_bucket' => $request->storage_bucket,
            'messaging_sender_id' => $request->messaging_sender_id,
            'app_id' => $request->app_id,
            'measurement_id' => $request->measurement_id,
        ]);

        flashSuccess('Push notification configuration updated .');
        return redirect()->back();
    }

    public function statusUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            'push_notification_status' => $request->status ? 1 : 0,
        ]);
        return ['success' => true];
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $notification = PushNotification::find($id);
        $notification->delete();
        flashSuccess('Push notification successfully deleted .');
        return redirect()->back();
    }

    public function send($id)
    {
        $notification = PushNotification::find($id);
        $this->sendNotification(null, $notification->title, $notification->body, $notification->url);
        flashSuccess('Push notification successfully sent .');
        return redirect()->back();
    }
}
