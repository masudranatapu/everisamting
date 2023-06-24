<?php

namespace App\Actions\Frontend;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use DB;
use Auth;
use Modules\Newsletter\Entities\Email;

class ProfileUpdate
{
    public static function update($request, $customer)
    {
        // dd($request->all());
        if($request->receive_email){

            $mailexist = Email::where('email', $request->email)->first();

            if($mailexist){

                Email::where('id', $mailexist->id)->update([
                    'email' => $request->email,
                ]);

            }else {
                Email::create(['email' => $request->email]);
            }

        }else {

            $mailexist = Email::where('email', $request->email)->first();
            if($mailexist) {
                $mailexist->delete();
            }

        }

        if($request->show_phone){
            $showphone = 0;
        }else {
            $showphone = 1;
        }

        if($request->show_email){
            $showemail = 0;
        }else {
            $showemail = 1;
        }

        DB::table('users')->where('id', Auth::user()->id)->update($request->except('image', '_token', '_method'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $user_profile = $request->file('image');
            $slug = 'user_profile';
            $customer_image_name = $slug.'-'.uniqid().'.'.$user_profile->getClientOriginalExtension();
            $upload_path = 'media/customer/profile/';
            $user_profile->move($upload_path, $customer_image_name);

            $url = $upload_path.$customer_image_name;

            $customer->update(['image' => $url]);

        }

        $customer->update([
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'is_social_login' => 2,
            'web' => $request->web,
            'show_phone' => $showphone,
            'show_email' => $showemail,
            'opening_hour' => $request->opening_hour,
            'closing_hours' => $request->closing_hours,
            'about_public_profile' => $request->about_public_profile,
            'receive_email' => $request->receive_email ?? 1,
        ]);
        // dd($customer);

        return $customer;
    }
}
