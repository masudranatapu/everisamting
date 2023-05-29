<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPlanMiddleware
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
        if ($userPlan =  session('user_plan')) {
            if ((int) $userPlan->ad_limit < 1) {
                session()->forget('user_plan');
                session()->put('user_plan', auth('user')->user()->userPlan);

                return redirect()->route('frontend.dashboard');
            }

            return $next($request);
        }

        session()->put('user_plan', auth('user')->user()->userPlan);

        return redirect()->route('frontend.dashboard');
    }
}
