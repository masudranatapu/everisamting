<?php

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

use Modules\MobileApp\Http\Controllers\MobileAppController;
use Modules\MobileApp\Http\Controllers\MobileAppSliderController;

Route::prefix('mobileapp')->group(function () {
    Route::get('/', 'MobileAppController@index');
});

Route::middleware(['auth:admin', 'set_lang'])->prefix('admin/settings')->group(function () {
    Route::get('mobile-config', 'MobileAppController@index')->name('mobile-config.index');
    Route::put('mobile-config', 'MobileAppController@update')->name('mobile-config.update');

    Route::get('mobile-slider', 'MobileAppSliderController@index')->name('mobile-slider.index');
    Route::get('mobile-slider/create', 'MobileAppSliderController@create')->name('mobile-slider.create');
    Route::post('mobile-slider', 'MobileAppSliderController@store')->name('mobile-slider.store');
    Route::get('mobile-slider/{id}', 'MobileAppSliderController@edit')->name('mobile-slider.edit');
    Route::put('mobile-slider/{id}', 'MobileAppSliderController@update')->name('mobile-slider.update');
    Route::delete('mobile-slider/{id}', 'MobileAppSliderController@destroy')->name('mobile-slider.destroy');
    Route::put('mobile-slider/order',  'MobileAppSliderController@updateOrder')->name('mobile-slider.updateOrder');
    Route::get('status/change', 'MobileAppSliderController@status_change')->name('mobile-slider.status.change');
});
