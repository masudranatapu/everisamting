<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // storePlanInformation();
        !session()->has('user_plan') ? storePlanInformation() : null;

        $user_plan = session('user_plan');

        if ($user_plan && $user_plan->subscription_type == 'recurring' && $user_plan->expired_date && $user_plan->plan_expired && !$user_plan->is_restored_plan_benefits) {
            $plan = Plan::findOrFail($user_plan->current_plan_id);

            if ($plan->ad_limit > $user_plan->ad_limit) {
                $user_plan->ad_limit = 0;
            } else {
                $user_plan->ad_limit = $user_plan->ad_limit - $plan->ad_limit;
            }
            if ($plan->featured_limit > $user_plan->featured_limit) {
                $user_plan->featured_limit = 0;
            } else {
                $user_plan->featured_limit = $user_plan->featured_limit - $plan->featured_limit;
            }
            $user_plan->is_restored_plan_benefits = 1;
            $user_plan->save();

            storePlanInformation();
            flashError('Your subscription has expired. Please renew your subscription.');
            return redirect()->route('frontend.priceplan');
        }

        return $next($request);
    }
}
