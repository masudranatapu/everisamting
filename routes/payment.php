<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\MollieController;
use App\Http\Controllers\Payment\PayPalController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Payment\MidtransController;
use App\Http\Controllers\Payment\PaystackController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\Payment\InstamojoController;
use App\Http\Controllers\Payment\FlutterwaveController;
use App\Http\Controllers\Payment\SslCommerzPaymentController;

//Paypal
Route::controller(PayPalController::class)->group(function () {
    Route::post('paypal/payment', 'processTransaction')->name('paypal.post');
    Route::get('success-transaction', 'successTransaction')->name('paypal.successTransaction');
    Route::get('cancel-transaction', 'cancelTransaction')->name('paypal.cancelTransaction');
});

// Paystack
Route::controller(PaystackController::class)->group(function () {
    Route::post('paystack/payment', 'redirectToGateway')->name('paystack.post');
    Route::get('/paystack/success', 'successPaystack')->name('paystack.success');
});

// SSLCOMMERZ
Route::controller(SslCommerzPaymentController::class)->prefix('payment')->group(function () {
    Route::post('/pay-via-ajax', 'payViaAjax')->name('ssl.pay');
    Route::post('/success', 'success');
    Route::post('/fail', 'fail');
    Route::post('/cancel', 'cancel');
    Route::post('/ipn', 'ipn');
});

// Stripe
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

// Razorpay
Route::post('payment', [RazorpayController::class, 'payment'])->name('razorpay.post');

// Flutterwave
Route::controller(FlutterwaveController::class)->group(function () {
    Route::post('/flutterwave/pay', 'initialize')->name('flutterwave.pay');
    Route::get('/rave/callback', 'callback')->name('flutterwave.callback');
});

// Instamojo
Route::controller(InstamojoController::class)->group(function () {
    Route::post('/instamojo/pay', 'pay')->name('instamojo.pay');
    Route::get('/instamojo/success', 'success')->name('instamojo.success');
});

// Midtrans
Route::controller(MidtransController::class)->group(function () {
    Route::post('/midtrans/success', 'success')->name('midtrans.success');
});

// Mollie
Route::controller(MollieController::class)->group(function () {
    Route::post('mollie-paymnet', 'preparePayment')->name('mollie.payment');
    Route::get('payment-success', 'paymentSuccess')->name('mollie.success');
});
