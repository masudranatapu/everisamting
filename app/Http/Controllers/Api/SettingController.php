<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Currency\Entities\Currency;

class SettingController extends Controller
{
    public function appSetting()
    {
        $currencies = Currency::first();
        $setting = Setting::select(
            "id",
            'customer_email_verification'
        )->first();
        $setting['topbar_phone'] = null;
        $setting['currency_name'] = $currencies->code;
        $setting['currency_icon'] = $currencies->symbol;
        $setting['app_name'] = env('APP_NAME');
        $setting['app_url'] = env('APP_URL');
        return sendResponse(200, "Setting", $setting, true);
    }
}
