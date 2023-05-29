<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (preg_match("@^/admin\b@", $request->getPathInfo())) {
            return route('admin.login');
        }


        if ($request->header('content-type') != null && $request->header('content-type') == "application/json") {
            abort(response()->json(
                [
                    'status' => '401',
                    'message' => 'Un Authenticated',
                ],
                401
            ));
        } else {
            return route('users.login');
        }
    }
}
