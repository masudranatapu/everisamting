<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error', $validator->errors()->first());
        }

        $this->broker()->sendResetLink(
            $this->credentials($request)
        );
        $message = 'We have emailed your password reset link';
        return sendResponse(200, $message, []);
    }
    // public function sendResetLinkEmail(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email',
    //     ]);

    //     if ($validator->fails()) {
    //         return sendError('Validation Error', $validator->errors()->first());
    //     }

    //     $customer = User::where('email', $request->email)->first();
    //     $token = rand(1000, 9999);

    //     if (!$customer) {
    //         $message = 'Email address not found';
    //         return sendError('Undefine', $message);
    //     }

    //     if (checkSetup('mail')) {
    //         $customer->notify(new ResetPassword($token));
    //     }
    //     $customer->update(['token' => $token]);

    //     $message = 'We have emailed your password reset code';
    //     return sendResponse(200, $message, []);
    // }
}
