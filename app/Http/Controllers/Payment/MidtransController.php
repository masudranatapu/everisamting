<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Notifications\MembershipUpgradeNotification;

class MidtransController extends Controller
{
    use PaymentTrait;

    public function success()
    {
        $payment_details = session('midtrans_details');

        $plan = Plan::findOrFail($payment_details['plan_id']);
        $this->userPlanInfoUpdate($plan);
        $this->createTransaction($payment_details['order_no'], 'Midtrans', $payment_details['total_price'], $plan->id);
        $user = auth('user')->user();
        $user->notify(new MembershipUpgradeNotification($user, $plan->label));
        storePlanInformation();

        session()->forget('payment_details');
        session()->flash('success', 'Payment Successfully');

        return response()->json([
            'redirect_url' => route('frontend.plans-billing'),
        ]);
    }
}
