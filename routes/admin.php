<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SocialiteController;
use App\Http\Controllers\Admin\CmsSettingController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventTagController;
use App\Http\Controllers\Admin\EventOrganiserController;
use App\Http\Controllers\Admin\EventVenuesController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\BusinessDirectoryController;

Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        // reset password
        Route::controller(ForgotPasswordController::class)->group(function () {
            // Route::post('password/email', 'sendResetLinkEmail')->name('admin.password.email');
            // Route::get('password/reset', 'showLinkRequestForm')->name('admin.password.request');
        });
        Route::controller(ResetPasswordController::class)->group(function () {
            // Route::post('password/reset', 'reset')->name('admin.password.update');
            // Route::get('password/reset/{token}', 'showResetForm')->name('admin.password.reset');
        });
    });

    Route::middleware(['auth:admin'])->group(function () {
        //Dashboard Route
        Route::controller(AdminController::class)->group(function () {
            Route::get('/',  'dashboard');
            Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
            Route::post('/admin/search', 'search')->name('admin.search');
        });

        //Profile Route
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile/settings', 'setting')->name('profile.setting');
            Route::get('/profile', 'profile')->name('profile');
            Route::put('/profile', 'profile_update')->name('profile.update');
        });

        //Roles Route
        Route::resource('role', RolesController::class);


        // event Route
        Route::resource('events', EventController::class);
        Route::resource('event-category', EventCategoryController::class);
        Route::resource('event-tags', EventTagController::class);
        Route::resource('event-organiser', EventOrganiserController::class);
        Route::resource('event-venues', EventVenuesController::class);

        // BusinessDirectory
        Route::resource('business-directory', BusinessDirectoryController::class);
        Route::get('business-directory/category/subcategory/{id}', [BusinessDirectoryController::class, 'businessCategorySubcategory']);
        Route::post('business-directory/fileImport', [BusinessDirectoryController::class, 'fileImport'])->name('business.fileImport');
        // Business directory author contact info
        Route::get('business-author-contact', [BusinessDirectoryController::class, 'businessDirectoryContact'])->name('business.author.cotnact');
        Route::get('business-author-delete/{id}', [BusinessDirectoryController::class, 'businessDirectoryContactDelete'])->name('business.author.delete');
        Route::get('business-claim', [BusinessDirectoryController::class, 'businessClaim'])->name('business.claim');
        Route::get('business-claim/stauts-change', [BusinessDirectoryController::class, 'businessClaimUpdateStatus'])->name('business.claim.status.update');
        Route::get('business-claim/delete/{id}', [BusinessDirectoryController::class, 'businessClaimDelete'])->name('business.claim.delete');

        //Users Route
        Route::resource('user', UserController::class);

        // Report
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');

        // ========================================================
        // ====================Setting=============================
        // ========================================================
        Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function () {
            Route::get('general', 'general')->name('general');
            Route::put('general', 'generalUpdate')->name('general.update');
            Route::get('layout', 'layout')->name('layout');
            Route::put('layout', 'layoutUpdate')->name('layout.update');
            Route::put('mode', 'modeUpdate')->name('mode.update');
            Route::get('theme', 'theme')->name('theme');
            Route::put('theme', 'colorUpdate')->name('theme.update');
            Route::get('custom', 'custom')->name('custom');
            Route::put('custom', 'custumCSSJSUpdate')->name('custom.update');
            Route::get('email', 'email')->name('email');
            Route::put('email', 'emailUpdate')->name('email.update');
            Route::post('test-email', 'testEmailSent')->name('email.test');

            // sytem update
            Route::get('system', 'system')->name('system');
            Route::put('system/update', 'systemUpdate')->name('system.update');
            Route::put('search/indexing', 'searchIndexing')->name('search.indexing');
            Route::put('google-analytics', 'googleAnalytics')->name('google.analytics');
            Route::put('facebook-pixel', 'facebookPixel')->name('facebook.pixel');
            Route::put('allowLangChanging', 'allowLaguageChanage')->name('allow.langChange');
            Route::put('change/timezone', 'timezone')->name('change.timezone');

            // cookies routes
            Route::get('cookies', 'cookies')->name('cookies');
            Route::put('cookies/update', 'cookiesUpdate')->name('cookies.update');

            // seo
            Route::get('seo/index', 'seoIndex')->name('seo.index');
            Route::get('seo/edit/{page}', 'seoEdit')->name('seo.edit');
            Route::put('seo/update/{page}', 'seoUpdate')->name('seo.update');

            // database backup
            Route::get('database/backup/index', 'backupIndex')->name('database.backup.index');
            Route::post('database/backup/store', 'backupStore')->name('database.backup.store');
            Route::delete('database/backup/destroy/{file}', 'backupDestroy')->name('database.backup.destroy');
            Route::get('database/backup/download/{file}', 'backupDownload')->name('database.backup.download');

            // recaptcha Update
            Route::put('recaptcha/update', 'recaptchaUpdate')->name('recaptcha.update');
            Route::post('recaptcha/update/status', 'recaptchaUpdateStatus')->name('recaptcha.status.update');

            // module routes
            Route::get('modules', 'module')->name('module');
            Route::put('module/update', 'moduleUpdate')->name('module.update');

            // website configuration
            Route::put('website/configuration/update', 'websiteConfigurationUpdate')->name('website.configuration.update');

            // pusher configuration
            Route::put('pusher/configuration/update', 'pusherConfigurationUpdate')->name('pusher.configuration.update');

            // website watermark update
            Route::put('website/watermark/update', 'websiteWatermarkUpdate')->name('website.watermark.update');
        });

        Route::controller(SocialiteController::class)->group(function () {
            Route::get('settings/social-login', 'index')->name('settings.social.login');
            Route::put('settings/social-login', 'update')->name('settings.social.login.update');
            Route::post('settings/social-login/status', 'updateStatus')->name('settings.social.login.status.update');
        });

        Route::controller(PaymentController::class)->group(function () {
            Route::get('settings/payment', 'index')->name('settings.payment');
            Route::put('settings/payment', 'update')->name('settings.payment.update');
            Route::post('settings/payment/status', 'updateStatus')->name('settings.payment.status.update');
        });


        // ==================== Skin System =====================
        Route::controller(ThemeController::class)->group(function () {
            Route::get('/skins', 'index')->name('module.themes.index');
            Route::put('/skins', 'update')->name('module.themes');
        });

        //====================Website Page Setting==============================
        Route::controller(SettingsController::class)->group(function () {
            Route::put('/posting-rules', 'postingRulesUpdate')->name('admin.posting.rules.upadte');
            Route::put('/about', 'updateAbout')->name('admin.about.upadte');
            Route::put('/terms', 'updateTerms')->name('admin.terms.upadte');
            Route::put('/privacy', 'updatePrivacy')->name('admin.privacy.upadte');
        });

        //====================Website SEO Setting==============================
        Route::put('/seo', [SettingsController::class, 'updateSeo'])->name('admin.seo.update');

        //====================Website CMS Setting==============================
        Route::controller(CmsSettingController::class)->prefix('settings')->group(function () {
            Route::get('/cms', 'index')->name('settings.cms');
            Route::put('/home', 'updateHome')->name('admin.home.update');
            Route::put('/about', 'updateAbout')->name('admin.about.update');
            Route::put('/terms', 'updateTerms')->name('admin.terms.update');
            Route::put('/privacy', 'updatePrivacy')->name('admin.privacy.update');
            Route::put('/posting-rules', 'postingRulesUpdate')->name('admin.posting.rules.update');
            Route::put('/get-membership', 'updateGetMembership')->name('admin.getmembership.update');
            Route::put('/pricing-plan', 'updatePricingPlan')->name('admin.pricingplan.update');
            Route::put('/blog', 'updateBlog')->name('admin.blog.update');
            Route::put('/ads', 'updateAds')->name('admin.ads.update');
            Route::put('/contact', 'updateContact')->name('admin.contact.update');
            Route::put('/faq', 'updateFaq')->name('admin.faq.update');
            Route::put('/dashboard', 'updateDashboard')->name('admin.dashboard.update');
            Route::put('/auth-content', 'updateAuthContent')->name('admin.authcontent.update');
            Route::put('/coming-soon', 'updateComingSoon')->name('admin.comingsoon.update');
            Route::put('/maintenance', 'updateMaintenance')->name('admin.maintenance.update');
            Route::put('/errorpages', 'updateErrorPages')->name('admin.errorpages.update');
        });
    });
});
