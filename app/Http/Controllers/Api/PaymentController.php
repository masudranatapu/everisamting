<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaymentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Plan\Entities\Plan;

use function GuzzleHttp\Promise\all;

class PaymentController extends Controller
{
    use PaymentTrait;

    public function paymentSuccess(Request $request)
    {
        $discription = [
            'plan_id' => 'Must provide a plan id as a integer',
            'status' => "payment success or failed",
            'order' => 'trx id or pay id',
            'payment_provider' => "Paypal or Stripe"
        ];

        try {
            //code...

            $plan = Plan::find($request->plan_id);
            Session::put('plan', $plan);
            $converted_amount = currencyConversion($plan->price,);

            session(['order_payment' => [
                'payment_provider' => $request->payment_provider,
                'amount' =>  $converted_amount,
                'currency_symbol' => '$',
                'usd_amount' =>  $converted_amount,
            ]]);


            $this->orderPlacing(false);


            return sendResponse(200, "Payment Success", [], true, $discription);
        } catch (\Exception $th) {
            Log::alert($th);
        }
    }
}
