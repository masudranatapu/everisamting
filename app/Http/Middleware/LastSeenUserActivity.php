<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LastSeenUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth('user')->check()) {
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('isOnline' . auth('user')->id(), true, $expiresAt);

            //Last Seen
            User::where('id', auth('user')->id())->update(['last_seen' => Carbon::now()]);
        }

        return $next($request);
    }
}
