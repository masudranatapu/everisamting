<?php

use Illuminate\Support\Facades\Route;
use Modules\PushNotification\Entities\UserDeviceToken;

include_once(base_path('routes/auth.php'));
include_once(base_path('routes/admin.php'));
include_once(base_path('routes/website.php'));
include_once(base_path('routes/payment.php'));
include_once(base_path('routes/command.php'));

Route::fallback(function () {
    abort(404);
});
