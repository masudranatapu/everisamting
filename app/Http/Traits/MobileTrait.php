<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;
use App\Notifications\AdDeleteNotification;

trait MobileTrait
{
    protected function permissionCheck($user_id)
    {
        if ($user_id) {
            if ($user_id != auth('api')->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not allowed to do this action'
                ], Response::HTTP_FORBIDDEN);
            }
        }
    }

    protected function addeleteNotification()
    {
        $user = auth('api')->user();
        if (checkSetup('mail')) {
            $user->notify(new AdDeleteNotification($user));
        }
    }
}
