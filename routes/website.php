<?php

use App\Http\Controllers\PushNotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\MessangerController;
use App\Http\Controllers\Frontend\AdPostController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\SellerDashboardController;
use App\Http\Controllers\Frontend\UserBusinessDirectoryController;

// show website pages
Route::group(['as' => 'frontend.'], function () {
    Route::get('/', [FrontendController::class, 'index'])->name('index');

    Route::controller(FrontendController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('about', 'about')->name('about');
        Route::get('faq', 'faq')->name('faq');
        Route::get('privacy', 'privacy')->name('privacy');
        Route::get('terms-conditions', 'terms')->name('terms');
        Route::get('get-membership', 'getMembership')->name('getmembership');
        Route::get('price-plan', 'pricePlan')->name('priceplan');
        Route::get('price-plan-details/{plan_label}', 'pricePlanDetails')->name('priceplanDetails');
        Route::get('contact', 'contact')->name('contact');
        Route::get('ad-list', 'adList')->name('adlist');
        Route::get('/ad/details/{ad:slug}', 'adDetails')->name('addetails');
        Route::get('/ad/gallery-details/{ad:slug}', 'adGalleryDetails')->name('ad.gallery.details');
        Route::get('blog', 'blog')->name('blog');
        Route::get('blog/{blog:slug}', 'singleBlog')->name('single.blog');
        Route::get('blog/comments/count/{post_id}', 'commentsCount');
        Route::post('ad/attachment/download/', 'attachmentDownload')->name('attachment.download');
        Route::post('/set/session', 'setSession')->name('set.session');
        Route::post('send/mail-to-customer', 'mailToCustomer')->name('mail.to.customer');
        Route::get('sellers', 'sellers')->name('sellers');
        // event
        Route::get('event', 'event')->name('event');
        Route::get('event/search', 'getEvent')->name('getEvent');
        Route::get('event/category/{id}/{slug}', 'eventCategory')->name('event.category');
        Route::get('event/tags/{id}/{slug}', 'eventTags')->name('event.tags');
        Route::get('event/create', 'eventCrate')->name('event.create');
        Route::post('event/store', 'eventStore')->name('event.store');
        Route::get('event-details/{id}/{slug}', 'eventDetails')->name('event.details');
        Route::get('getEventTooltip', 'getEventTooltip')->name('event.tooltip');

        // business directory
        Route::get('business/directories', 'businessDirectories')->name('business.directories');
        Route::get('business/details/{id}/{slug}', 'businessDetails')->name('business.details');
        Route::post('contact/author', 'contactAuthor')->name('contact.author');
        Route::post('business/directory/claim', 'businessDirectoryClaim')->name('business.directory.claim');
    });

    //seller dashboard
    Route::controller(SellerDashboardController::class)->group(function () {
        Route::get('/seller/{user:username}', 'profile')->name('seller.profile');
        Route::post('/seller/rate', 'rateReview')->name('seller.review');
        Route::post('/pre/signup', 'preSignup')->name('pre.signup');
        Route::post('/report', 'report')->name('seller.report');
    });

    Route::get('ads/{category?}', [FilterController::class, 'search'])->name('adlist.search');
    Route::get('category/{slug}', [FilterController::class, 'adsByCategory'])->name('adlist.category.show');

    // customer dashboard
    Route::prefix('dashboard')->middleware(['auth:user', 'verified'])->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::resource('user-business-directory', UserBusinessDirectoryController::class);
        Route::get('user-business-directory/category/subcategory/{id}', [UserBusinessDirectoryController::class, 'businessCategorySubcategory']);

        Route::controller(AdPostController::class)->prefix('post')->group(function () {

            // Ad Create
            Route::middleware(['checkplan', 'check_subscription'])->group(function () {
                Route::get('/', 'postStep1')->name('post');
                Route::get('create/{category}', 'create')->name('post.create');
                Route::post('/store', 'store')->name('post.store');
//                Route::post('/', 'storePostStep1')->name('post.store');
                Route::get('/step2', 'postStep2')->name('post.step2');
                Route::post('/step2', 'storePostStep2')->name('post.step2.store');
                Route::get('/step3', 'postStep3')->name('post.step3');
                Route::post('/step3', 'storePostStep3')->name('post.step3.store');
                Route::get('/step2/back/{slug?}', 'postStep2Back')->name('post.step2.back');
                Route::get('/step1/back/{slug?}', 'postStep1Back')->name('post.step1.back');
                Route::get('get_brand/{id}', 'getBrand');
            });

            // Ad Edit
            Route::get('/gallery/images/{ad_gallery}', 'adGalleryDelete')->name('ad.gallery.delete');
            Route::get('edit/{ad:slug}', 'edit')->name('post.edit');
            Route::post('update/{ad:slug}', 'update')->name('post.update');
//            Route::get('/{ad:slug}', 'editPostStep1')->name('post.edit');
//            Route::put('/{ad:slug}/update', 'UpdatePostStep1')->name('post.update');
            Route::get('/{ad:slug}/step2', 'editPostStep2')->name('post.edit.step2');
            Route::put('/step2/{ad:slug}/update', 'updatePostStep2')->name('post.step2.update');
            Route::get('/{ad:slug}/step3', 'editPostStep3')->name('post.edit.step3');
            Route::put('/step3/{ad:slug}/update', 'updatePostStep3')->name('post.step3.update');
            Route::get('/cancel/edit', 'cancelAdPostEdit')->name('post.cancel.edit');
        });

        // Messenger
        Route::controller(MessangerController::class)->group(function () {
            Route::get('message/{username?}', 'index')->name('message');
            Route::post('message/{username}', 'sendMessage')->name('message.store');
            Route::post('message/markas/read/{username}', 'messageMarkasRead')->name('message.markas.read');
        });

        Route::controller(DashboardController::class)->group(function () {
            Route::get('post-rules', 'postRules')->name('post.rules');
            Route::get('ad/{ad:slug}', 'editAd')->name('editad');
            Route::get('ads', 'myAds')->name('adds');
            Route::delete('delete-


            /{ad}', 'deleteMyAd')->name('delete.myad');
            Route::put('status-ads/{ad}', 'myAdStatus')->name('myad.status');
            Route::put('expire-ads/{ad}', 'markExpired')->name('myad.expire');
            Route::put('active-ad/{ad}', 'markActive')->name('myad.active');
            Route::get('my-event', 'event')->name('myevent');
            Route::get('my-event-edit/{id}', 'eventEdit')->name('myevent.edit');
            Route::post('my-event-update/{id}', 'eventUpdate')->name('myevent.update');
            Route::get('my-event-delete/{id}', 'eventDelete')->name('myevent.delete');
            Route::get('favourites', 'favourites')->name('favourites');
            Route::get('plans-billing', 'plansBilling')->name('plans-billing');
            Route::get('cancel/plan', 'cancelPlan')->name('cancel-plan');
            Route::get('account-setting', 'accountSetting')->name('account-setting');
            Route::put('profile', 'profileUpdate')->name('profile');
            Route::put('password', 'passwordUpdate')->name('password');
            Route::put('social', 'socialUpdate')->name('social.update');
            Route::post('wishlist', 'addToWishlist')->name('add.wishlist');
            Route::delete('account-delete/{customer}', 'deleteAccount')->name('account.delete');
        });
    });
});

// Verification Routes
Route::controller(VerificationController::class)->middleware('auth:user', 'set_lang')->group(function () {
    Route::get('/email/verify', 'show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'resend')->name('verification.resend');
});


Route::get('webhooks', function (Request $request) {
    $uri = route('webhooks', ['hub_mode=>subscribe', 'hub_challenge=1158201444', 'hub_verify_token' => 'mkdsToken']);
    return $uri;
})->name('webhooks');

Route::get('/get-sub-categories/{category_id}', [AdPostController::class, 'getSubcategories']);
Route::get('get-product-models', [AdPostController::class, 'getProductModel'])->name('getProductModel');

Route::get('/saveDeviceToken', [PushNotificationController::class, 'saveDeviceToken'])->name('notification.save-token');
