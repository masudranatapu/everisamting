<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SocialSetting;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $socialiteUserId = $socialiteUser->getId();
        $socialiteUserName = $socialiteUser->getName();
        $socialiteUseremail = $socialiteUser->getEmail();

        $user = User::where([
            'provider' => $provider,
            'provider_id' =>  $socialiteUserId,
        ])->first();

        if (!$user) {

            $validator = Validator::make(
                ['email' => $socialiteUseremail],
                ['email' => ['unique:users,email']],
                ['email.unique' => 'Maybe you used a different login method with this email?'],
            );

            if ($validator->fails()) {
                return redirect()->route('users.login')->withErrors($validator);
            }

            $user = User::create([
                'name' => $socialiteUserName,
                'username' => strtolower(str_replace(' ', '', $socialiteUserName.rand(0, 99999))),
                'email' => $socialiteUseremail,
                'provider' => $provider,
                'email_verified_at' => Carbon::now(),
                'provider_id' =>  $socialiteUserId,
                'is_social_login' => 1,
            ]);
        }else {
            Auth::guard('user')->login($user);
            return redirect()->route('frontend.dashboard');
        }

        Auth::guard('user')->login($user);

        return redirect()->route('frontend.account-setting');

    }
}
