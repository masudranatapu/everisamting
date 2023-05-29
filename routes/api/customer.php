<?php

use App\Models\UserPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MessengerController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController as AuthForgotPasswordController;

Route::get('/test', function (Request $request) {

    $token = JWTAuth::getToken();

    return $user = JWTAuth::setToken($token)->toUser();
    return $user = JWTAuth::toUser($token);
    return auth('api')->user();


    $header = $request->header('Authorization', '');
    if (Str::startsWith($header, 'Bearer ')) {
        $token = Str::substr($header, 7);
    }

    return $user;

    $payload = JWTAuth::getPayload($token);
    return $payload;
    // get payloads in the token





    return JWTAuth::user();

    return JWTAuth::parseToken()->authenticate();
    // return $request->token;
    $user = JWTAuth::toUser($request);
    return $user;

    return UserPlan::customerData(1)->firstOrFail();
    return auth('api')->user();
    return 'test';
});

Route::middleware(['auth:api'])->group(function () {
    // Customer Controller
    Route::controller(CustomerController::class)->middleware(['auth:api'])->group(function () {
        Route::post('/auth/password', 'passwordUpdate');
        Route::post('/auth/profile', 'profileUpdate');
        Route::get('/customer/ads', 'allAds');
        Route::get('/customer/recent-ads', 'recentAds');
        Route::put('/customer/ads/{ad}/active', 'activeAd');
        Route::put('/customer/ads/{ad}/expire', 'expireAd');
        Route::delete('/customer/ads/{ad}/delete', 'deleteAd');
        Route::delete('/customer/account-delete', 'deleteCustomer');
        Route::post('/ads/favourite/{ad?}', 'favouriteAddRemove');
        Route::get('/customer/dashboard-overview', 'dashboardOverview');
        Route::get('/customer/dashboard-adsviews', 'adsViewsSummery');
        Route::get('/customer/favourite-list', 'favouriteAds');
        Route::get('/customer/recent-invoices', 'recentInvoice');
        Route::get('/customer/activity-logs', 'activityLogs');
        Route::get('/customer/plan', 'planLimit');
        Route::get('/customer/transactions', 'planHistory');

        Route::get('/pamentgetways', 'pamentgetways');
        Route::post('/customer/plan-upgrade/testing', 'planUpgradeTesting');
        Route::post('/social', 'socialUpdate')->name('social.update');

        Route::post('store/bussiness/directory', 'businessDirectoryStore');
        Route::post('update/bussiness/directory/{id}', 'businessDirectoryUpdate');
        Route::get('delete/bussiness/directory/{id}', 'businessDirectoryDelete');
        Route::get('user/event', 'userEvent');
        Route::post('store/event', 'eventStore');
        Route::post('update/event/{id}', 'eventUpdate');
        Route::get('delete/event/{id}', 'eventDelete');



        Route::get('/user/directories', 'userBusinessDirectories');
        Route::post('business/claim/{id}', 'businessClim');



        // Payment
        Route::post('payment-success', [PaymentController::class, 'paymentSuccess']);
        // Messenger Controller

        Route::get('chats/user-list', [MessengerController::class, 'index']);
        Route::get('chats/{username}', [MessengerController::class, 'show']);
        Route::post('chats/{username}', [MessengerController::class, 'sendMessage']);


        // Route::controller(MessengerController::class)->group(function () {
        //     Route::get('chat/{username?}', 'index');

        //     Route::post('chat/{username}', 'sendMessage');

        // });


        Route::post('contact/author',  'contactAuthor')->name('contact.author');

        Route::post('/seller/review/{user:username}', [HomeController::class, 'sellerReview']);
        Route::post('seller/report', 'report');

    });
});

// Category Controller
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'categories');
    Route::get('/categories/{category}/subcategories', 'categoriesSubcategories');
});

// Ad Controller
Route::controller(AdController::class)->group(function () {
    Route::get('/ads', 'adsCollection');
    Route::get('/ads/{category}/category', 'categoryWiseAds');
    Route::get('/ads/{ad:slug}', 'adDetails');
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/ads/create', 'storeAd');
        Route::get('/ads/edit/{ad}', 'editAd');
        Route::post('/ads/update/{ad}', 'updateAd');
    });
});

// App Controller
Route::controller(AppController::class)->group(function () {
    Route::get('/testimonials', 'testimonialList');
    Route::post('/contacts/send', 'contactMessage');
    Route::get('/faqscategories', 'faqsCategory');
    Route::get('/faqscategories/{category}/faq', 'categoriesFaq');
    Route::get('/cities', 'cities');
    Route::get('/contact-content', 'contactContent');
    Route::get('/postingrules-content', 'postingrulesContent');
    Route::get('/about-content', 'aboutContent');
    Route::get('/brands', 'brands');
    Route::get('/pricing-plans', 'planList');
    Route::get('/terms-conditions', 'termsConditions');
    Route::get('/privacy-policy', 'privacy');
});


// App setting
Route::get('/settings', [SettingController::class, 'appSetting']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('seller/list', [HomeController::class, 'seller'])->name('sellers');
Route::get('/seller/{user:username}', [HomeController::class,  'profile'])->name('seller.profile');
Route::get('/business/directories', [HomeController::class, 'businessDirectories']);
Route::get('/business/directories/category', [HomeController::class, 'businessDirectoriesCategory']);
Route::get('/business/details/{id}/{slug}', [HomeController::class, 'businessDetails']);

Route::get('/events', [HomeController::class, 'events']);
Route::get('/events', [HomeController::class, 'events']);
Route::get('/events/params', [HomeController::class, 'eventsParams']);
// Route::get('/events/tag', [HomeController::class, 'eventsTag']);
// Route::get('/events/venues', [HomeController::class, 'eventsVenues']);
// Route::get('/event/organiser', [HomeController::class, 'eventsOrganiser']);



Route::prefix('lenguage')->group(function () {
    Route::get('/sync', [HomeController::class, 'lenguageSync']);
    Route::get('/{code}', [HomeController::class, 'getLenguage']);
});

Route::post('/send-forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);

Route::post('customer/password/mail', [AuthForgotPasswordController::class, 'sendResetLinkEmail']);
