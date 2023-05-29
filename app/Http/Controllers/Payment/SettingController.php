<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public $paymentSetting;

    public function __construct()
    {
        $this->paymentSetting = PaymentSetting::first();
    }
}
