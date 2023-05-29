<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => "required|string|max:100|email",
            'password' => "required|min:8|max:50",
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error', $validator->errors()->first());
        }


        $customer = User::where('email', $request->email)->first();

        if ($customer->token == $request->token) {
            $customer->update([
                'token' => null,
                'password' => bcrypt($request->password),
            ]);

            $message = 'Your password has been reset';
            return sendResponse(200, $message);
        }

        $message = 'Invalid token';
        return sendError('Invalid', $message);
    }
}
