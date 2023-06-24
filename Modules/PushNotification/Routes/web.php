<?php

use Illuminate\Support\Facades\Route;
use Modules\PushNotification\Http\Controllers\PushNotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/store-token', [PushNotificationController::class, 'updateDeviceToken'])->name('store.token');
Route::post('/send-web-notification', [PushNotificationController::class, 'sendNotification'])->name('send.web-notification');


// push notification configuration update routes for admin
Route::middleware(['auth:admin'])->prefix('admin/push/notification')->as('admin.push.notification.')->group(function () {
    Route::get('/', [PushNotificationController::class, 'index'])->name('index');
    Route::get('/create', [PushNotificationController::class, 'create'])->name('create');
    Route::post('/store', [PushNotificationController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PushNotificationController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PushNotificationController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PushNotificationController::class, 'destroy'])->name('delete');

    Route::get('/send/{id}', [PushNotificationController::class, 'send'])->name('send');
    Route::put('/setting/update', [PushNotificationController::class, 'SettingUpdate'])->name('setting.update');
    Route::post('/status/update', [PushNotificationController::class, 'statusUpdate'])->name('status.update');
});
