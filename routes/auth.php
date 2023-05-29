<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

//====================Frontend Authentication=========================
Auth::routes(['login' => false, 'register' => false]);

// registration proccess
Route::controller(FrontendController::class)->group(function () {
    Route::get('/sign-up', 'signUp')->name('frontend.signup');
    Route::post('customer/register', 'register')->name('customer.register');
    Route::post('/frontend/logout', 'frontendLogout')->name('frontend.logout');
});

// login proccess
Route::post('/customer/login', [App\Http\Controllers\Frontend\LoginController::class, 'login'])->name('frontend.login')->middleware('auth_logout');

// Customer Reset Password
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forgot/password', 'customerResetPasswordForm')->name('customer.forgot.password');
    Route::post('customer/password/mail', 'sendResetLinkEmail')->name('customer.password.email');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('password-reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('customer-password-update', 'reset')->name('customer.password.update');
});

// Social Authentication
Route::controller(SocialLoginController::class)->group(function () {
    Route::get('/auth/{provider}/redirect', 'redirect')->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket')->name('social.login');
    Route::get('/auth/{provider}/callback', 'callback')->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket');
});

//Auth Guard Logout
Route::post('auth-logout', function (Request $request) {
    if ($request->auth === 'customer') {
        Auth::guard('user')->logout();
        return redirect()->route('users.login');
    }
})->name('auth.logout');


Route::get('login', [App\Http\Controllers\Frontend\LoginController::class, 'showLoginForm'])
    ->name('users.login');

//====================Admin Authentication=========================
Route::controller(AdminLoginController::class)->prefix('admin')->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.admin');
    Route::post('/login', 'login')->name('admin.login');
    Route::post('/logout', 'logout')->name('admin.logout');
});

Route::middleware(['guest:admin'])->group(function () {
    // reset password
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::post('password/email', 'sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset', 'showLinkRequestForm')->name('admin.password.request');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::post('password/reset', 'reset')->name('admin.password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('admin.password.reset');
    });
});
