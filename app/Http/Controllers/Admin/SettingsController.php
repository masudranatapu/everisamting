<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Models\Cookies;
use App\Models\Setting;
use App\Models\Timezone;
use App\Traits\UploadAble;
use App\Mail\SmtpTestEmail;
use msztorc\LaravelEnv\Env;
use Illuminate\Http\Request;
use App\Models\ModuleSetting;
use App\Models\DatabaseBackup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Modules\Currency\Entities\Currency;
use Modules\Language\Entities\Language;
use Modules\SetupGuide\Entities\SetupGuide;
use Modules\Currency\Http\Controllers\CurrencyController;
use Modules\Language\Http\Controllers\TranslationController;

class SettingsController extends Controller
{
    use UploadAble;

    public function __construct()
    {
        $this->middleware(['permission:setting.view|setting.update'])->only(['website', 'layout', 'color', 'custom', 'email', 'system']);

        $this->middleware(['permission:setting.update'])->only([
            'websiteUpdate', 'layoutUpdate', 'colorUpdate', 'custumCSSJSUpdate',
            'modeUpdate', 'emailUpdate', 'testEmailSent',
            'searchIndexing', 'googleAnalytics', 'facebookPixel'
        ]);
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function general()
    {
        $timezones = Timezone::all();
        $setting = Setting::first();
        $currencies = Currency::all();
        return view('admin.settings.pages.general', compact('timezones', 'setting', 'currencies'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function theme()
    {
        return view('admin.settings.pages.theme');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function custom()
    {
        return view('admin.settings.pages.custom');
    }

    /**
     * Website Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function generalUpdate(Request $request)
    {
        $request->validate([
            'name'      =>  ['required'],
            'logo_image'      =>  ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:3072'],
            'white_logo'      =>  ['nullable', 'mimes:png,jpg,svg,jpeg', 'max:3072'],
            'favicon_image'      =>  ['nullable', 'mimes:png,ico', 'max:1024'],
        ]);

        if ($request->name && $request->name != env('APP_NAME')) {
            setEnv('APP_NAME', $request->name);
        }

        $setting = Setting::first();
        if ($request->hasFile('logo_image')) {
            $setting['logo_image'] = uploadFileToPublic($request->logo_image, 'app/logo');
            deleteFile($setting->logo_image);
        }

        if ($request->hasFile('loader_image')) {
            $setting['loader_image'] = uploadFileToPublic($request->loader_image, 'app/loaderimage');
            deleteFile($setting->loader_image);
        }

        if ($request->hasFile('white_logo')) {
            $setting['white_logo'] = uploadFileToPublic($request->white_logo, 'app/logo');
            deleteFile($setting->white_logo);
        }

        if ($request->hasFile('favicon_image')) {
            $setting['favicon_image'] = uploadFileToPublic($request->favicon_image, 'app/logo');
            deleteFile($setting->favicon_image);
        }

        $setting->save();
        SetupGuide::where('task_name', 'app_setting')->update(['status' => 1]);

        return back()->with('success', 'Website setting updated successfully!');
    }

    /**
     * Update website layout
     *
     * @return void
     */
    public function layoutUpdate()
    {
        Setting::first()->update(request()->only('default_layout'));

        return back()->with('success', 'Website layout updated successfully!');
    }

    /**
     * color Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function colorUpdate()
    {
        Setting::first()->update(request()->only(['sidebar_color', 'nav_color', 'sidebar_txt_color', 'nav_txt_color', 'main_color', 'accent_color', 'frontend_primary_color', 'frontend_secondary_color']));

        SetupGuide::where('task_name', 'theme_setting')->update(['status' => 1]);

        return back()->with('success', 'Color setting updated successfully!');
    }

    /**
     * custom js and css Data Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function custumCSSJSUpdate()
    {
        Setting::first()->update(request()->only(['header_css', 'header_script', 'body_script']));

        return back()->with('success', 'Custom css/js updated successfully!');
    }

    /**
     * Mode Update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function modeUpdate(Request $request)
    {
        $dark_mode = $request->only(['dark_mode']);
        Setting::first()->update($dark_mode);

        return back()->with('success', 'Theme updated successfully!');
    }

    public function email()
    {
        return view('admin.settings.pages.mail');
    }

    /**
     * Update mail configuration settings on .env file
     *
     * @param Request $request
     * @return void
     */
    public function emailUpdate(Request $request)
    {
        $request->validate([
            'mail_host'     =>  ['required',],
            'mail_port'     =>  ['required', 'numeric'],
            'mail_username'     =>  ['required',],
            'mail_password'     =>  ['required',],
            'mail_encryption'     =>  ['required',],
            'mail_from_name'     =>  ['required',],
            'mail_from_address'     =>  ['required', 'email'],
        ]);

        $data = $request->only(['mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_name', 'mail_from_address']);

        foreach ($data as $key => $value) {
            $env = new Env();
            $env->setValue(strtoupper($key), $value);
        }
        SetupGuide::where('task_name', 'smtp_setting')->update(['status' => 1]);

        return back()->with('success', 'Mail configuration update successfully');
    }


    /**
     * Send a test email for check mail configuration credentials
     *
     * @return void
     */
    public function testEmailSent()
    {
        request()->validate(['test_email' => ['required', 'email']]);
        try {
            Mail::to(request()->test_email)->send(new SmtpTestEmail);

            return back()->with('success', 'Test email sent successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Invalid email configuration. Mail send failed.');
        }
    }



    /**
     * View Website mode page
     *
     * @return void
     */
    public function system()
    {
        $timezones = Timezone::all();
        $setting = Setting::first();
        $currencies = Currency::all();

        return view('admin.settings.pages.preference', compact('timezones', 'setting', 'currencies'));
    }

    public function systemUpdate(Request $request)
    {
        if ($request->has('timezone')) {

            $this->timezone($request);
        }
        if ($request->has('code')) {

            (new TranslationController())->setDefaultLanguage($request);
        }

        if ($request->app_debug == 1) {
            Artisan::call('env:set APP_DEBUG=true');
        } else {
            Artisan::call('env:set APP_DEBUG=false');
        }

        if ($request->has('language_changing')) {

            $this->allowLaguageChanage($request);
        }

        if ($request->has('currency')) {

            (new CurrencyController())->defaultCurrency($request);
        }

        $setting = Setting::first();
        $setting->update([
            'email_verification' => $request->email_verification ? true : false,
        ]);

        if ($request->commingsoon_mode) {
            setEnv('APP_MODE', 'comingsoon');
            return back()->with('success', 'App is in coming soon mode!');
        } elseif ($request->maintenance_mode) {
            setEnv('APP_MODE', 'maintenance');
            return back()->with('success', 'App is in maintenance mode!');
        } else {
            setEnv('APP_MODE', 'live');
            return back()->with('success', 'App is now live');
        }

        flashSuccess('App Configuration Updated!');
        return redirect()->back();
    }

    /**
     * Update search engine indexing setting
     *
     * @return void
     */
    public function searchIndexing($request)
    {
        try {
            if ($request->has('search_engine_indexing') && $request->search_engine_indexing == 1) {
                $data = "User-agent: *\nDisallow:";
            } else {
                $data = "User-agent: *\nDisallow: /";
            }
            file_put_contents(\public_path('robots.txt'), $data);

            if ($request->search_engine_indexing == 1) {

                Setting::first()->update(['search_engine_indexing' => true]);
            } else {
                Setting::first()->update(['search_engine_indexing' => false]);
            }

            return back()->with('success', 'Search Engine Indexing update successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Search Engine Indexing update failed.');
        }
    }


    /**
     * Update google analytics setting
     *
     * @return void
     */
    public function googleAnalytics($request)
    {
        if ($request->google_analytics == 1) {
            Setting::first()->update(['google_analytics' => true]);
        } else {
            Setting::first()->update(['google_analytics' => false]);
        }

        $env = new Env();
        $env->setValue(strtoupper('GOOGLE_ANALYTICS_ID'), request('google_analytics_id', ''));

        session()->put('google_analytics', request('google_analytics', 0));

        return back()->with('success', 'Google Analytics update successfully!');
    }


    /**
     * Update facebook pixel setting
     *
     * @return void
     */
    public function facebookPixel($request)
    {
        $env = new Env();
        $env->setValue(strtoupper('FACEBOOK_PIXEL_ID'), request('facebook_pixel_id', ''));

        if ($request->facebook_pixel == 1) {

            Setting::first()->update([
                'facebook_pixel' => true,
            ]);
        } else {

            Setting::first()->update([
                'facebook_pixel' => false,
            ]);
        }

        session()->put('facebook_pixel', request('facebook_pixel', 0));

        return back()->with('success', 'Facebook Pixel update successfully!');
    }

    public function allowLaguageChanage($request)
    {
        Setting::first()->update([
            'language_changing' => request('language_changing', 0)
        ]);

        flashSuccess('Language changing status changed!');
    }

    public function timezone($request)
    {
        $request->validate([
            'timezone' => "required"
        ]);

        $timezone = $request->timezone;

        if ($timezone && $timezone != config('app.timezone')) {
            envReplace('APP_TIMEZONE', $timezone);

            flashSuccess('Timezone Updated Successfully!');
        }

        flashError('Timezone update failed!');
    }

    public function cookies()
    {
        $cookie = Cookies::firstOrFail();

        return view('admin.settings.pages.cookies', compact('cookie'));
    }

    public function cookiesUpdate(Request $request)
    {
        // validating request data
        $request->validate([
            'cookie_name' => 'required|max:50|string',
            'cookie_expiration' => 'required|numeric|max:365',
            'title' => 'required',
            'description' => 'required',
            'approve_button_text' => 'required|string|max:30',
            'decline_button_text' => 'required|string|max:30',
        ]);
        // updating data to database
        $cookies = cookies();
        $cookies->allow_cookies = request('allow_cookies', 0);
        $cookies->cookie_name = $request->cookie_name;
        $cookies->cookie_expiration = $request->cookie_expiration;
        $cookies->force_consent = request('force_consent', 0);
        $cookies->darkmode = request('darkmode', 0);
        $cookies->title = $request->title;
        $cookies->approve_button_text = $request->approve_button_text;
        $cookies->decline_button_text = $request->decline_button_text;
        $cookies->description = $request->description;
        $cookies->save();
        // flashing success message and redirecting back
        flashSuccess('Cookies settings successfully updated!');
        return back();
    }

    public function seoIndex()
    {

        $seos = Seo::all();
        return view('admin.settings.pages.seo.index', compact('seos'));
    }

    public function seoEdit($page)
    {
        $seo = Seo::FindOrFail($page);
        return view('admin.settings.pages.seo.edit', compact('seo'));
    }

    public function seoUpdate(Request $request, $page)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $page = Seo::where('page_slug', $page)->first();
        $page->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($request->image != null && $request->hasFile('image')) {

            deleteFile($page->image);

            $path = 'images/seo';
            $image = uploadImage($request->image, $path);

            $page->update([
                'image' => $image,
            ]);
        }

        flashSuccess('Page Meta Data Edited');

        return redirect()->route('settings.seo.index');
    }

    public function backupIndex()
    {
        $backups = DatabaseBackup::latest()->paginate(20);
        return view('admin.settings.pages.database-backup', compact('backups'));
    }

    public function backupDownload(DatabaseBackup $file)
    {

        $path = $file->file_path;
        $fileName = $file->name;

        return response()->download($path, $fileName);
    }

    public function backupStore(Request $request)
    {

        Artisan::call('database:backup');

        flashSuccess('New backup is ready');
        return redirect()->back();
    }

    public function storeBackup($name, $path)
    {

        DatabaseBackup::create([
            'name' => $name,
            'file_path' => $path,
        ]);
    }

    public function backupDestroy(DatabaseBackup $file)
    {
        $backup = $file->file_path;
        if (file_exists($backup)) {
            unlink($backup);
        }

        $file->delete();

        flashSuccess('Backup Deleted');
        return redirect()->back();
    }

    public function recaptchaUpdate(Request $request)
    {
        $request->validate([
            'nocaptcha_key' => 'required',
            'nocaptcha_secret' => 'required',
        ]);

        checkSetEnv('NOCAPTCHA_SITEKEY', $request->nocaptcha_key);
        checkSetEnv('NOCAPTCHA_SECRET', $request->nocaptcha_secret);

        flashSuccess('Recaptcha Configuration updated!');
        return back();
    }

    public function recaptchaUpdateStatus(Request $request)
    {
        $status = $request->status;

        setEnv('NOCAPTCHA_ACTIVE', $status ? 'true' : 'false');

        return response()->json(['success' => true]);
    }

    public function module()
    {
        $modulesetting = ModuleSetting::first();

        return view('admin.settings.pages.module', compact('modulesetting'));
    }

    public function moduleUpdate(Request $request)
    {
        $blog = $request->blog ?? false;
        $newsletter = $request->newsletter ?? false;
        $language = $request->language ?? false;
        $price_plan = $request->price_plan ?? false;
        $testimonial = $request->testimonial ?? false;
        $faq = $request->faq ?? false;
        $contact = $request->contact ?? false;
        $appearance = $request->appearance ?? false;

        ModuleSetting::first()->update([
            'blog' => $blog,
            'newsletter' => $newsletter,
            'language' => $language,
            'price_plan' => $price_plan,
            'testimonial' => $testimonial,
            'faq' => $faq,
            'contact' => $contact,
            'appearance' => $appearance,
        ]);

        flashSuccess('Module settings updated!');
        return back();
    }

    public function websiteConfigurationUpdate(Request $request)
    {
        $request->validate([
            'free_ad_limit' => 'nullable|numeric',
            'free_featured_ad_limit' => 'nullable|numeric',
            'free_business_directory_limit' => 'nullable|numeric',
            'maximum_ad_image_limit' => 'nullable|numeric',
            'subscription_type' => 'nullable',
        ]);

        $setting = Setting::first();
        $setting->website_loader = $request->website_loader ?? false;
        $setting->regular_ads_homepage = $request->regular_ads_homepage ?? false;
        $setting->featured_ads_homepage = $request->featured_ads_homepage ?? false;
        $setting->customer_email_verification = $request->customer_email_verification ?? 0;
        $setting->ads_admin_approval = $request->ads_admin_approval ?? false;
        $setting->free_ad_limit = $request->free_ad_limit;
        $setting->free_business_directory_limit = $request->free_business_directory_limit;
        $setting->free_featured_ad_limit = $request->free_featured_ad_limit;
        $setting->maximum_ad_image_limit = $request->maximum_ad_image_limit;
        $setting->subscription_type = $request->subscription_type;
        $setting->fb_access_token = $request->fb_access_token;
        $setting->fb_app_id = $request->fb_app_id;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->youtube = $request->youtube;
        $setting->linkdin = $request->linkdin;
        $setting->whatsapp = $request->whatsapp;
        $setting->save();

        flashSuccess('Website configuration updated!');
        return back();
    }

    public function pusherConfigurationUpdate(Request $request)
    {
        $request->validate([
            'pusher_app_id' => 'required',
            'pusher_app_key' => 'required',
            'pusher_app_secret' => 'required',
            'pusher_app_cluster' => 'required',
        ]);


        checkSetEnv('PUSHER_APP_ID', $request->pusher_app_id);
        checkSetEnv('PUSHER_APP_KEY', $request->pusher_app_key);
        checkSetEnv('PUSHER_APP_SECRET', $request->pusher_app_secret);
        checkSetEnv('PUSHER_APP_CLUSTER', $request->pusher_app_cluster);

        SetupGuide::where('task_name', 'pusher_setting')->update(['status' => 1]);

        flashSuccess('Pusher Configuration updated!');
        return back();
    }

    public function websiteWatermarkUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            'watermark_status' => $request->watermark_status ? true : false,
            'watermark_type' => $request->watermark_type,
        ]);

        $request->validate([
            'watermark_type' => 'required',
        ]);

        if ($request->watermark_type == 'text') {

            $request->validate([
                'text' => 'required|max:32'
            ]);

            $setting = Setting::first();
            $setting->update([
                'watermark_text' => $request->text,
            ]);
        } else {

            if ($request->hasFile('image')) {

                $oldImg = $setting->watermark_image;
                if (file_exists($oldImg)) {
                    if (!'frontend/image/logo.png') {
                        unlink($oldImg);
                    }
                }

                $image = uploadImage($request->image, 'watermark');

                $setting->update([
                    'watermark_image' => $image,
                ]);
            }
        }

        flashSuccess('Watermark data updated !');

        return redirect()->back();
    }
}
