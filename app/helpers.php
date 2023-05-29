<?php

use Carbon\Carbon;
use App\Models\Seo;
use App\Models\Theme;
use AmrShawky\Currency;
use App\Models\Cookies;
use App\Models\Setting;
use Illuminate\Support\Str;
use msztorc\LaravelEnv\Env;
use App\Models\ModuleSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Modules\Language\Entities\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

/**
 * image delete
 *
 * @param string $image
 * @return void
 */
if (!function_exists('deleteFile')) {
    function deleteFile(?string $image)
    {
        $imageExists = file_exists($image);

        if ($imageExists) {
            if ($imageExists != 'backend/image/default-user.png') {
                @unlink($image);
            }
        }
    }
}

/**
 * @param UploadedFile $file
 * @param null $folder
 * @param string $disk
 * @param null $filename
 * @return false|string
 */
if (!function_exists('uploadOne')) {
    function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : uniqid('FILE_') . dechex(time());

        return $file->storeAs(
            $folder,
            $name . "." . $file->getClientOriginalExtension(),
            $disk
        );
    }
}

/**
 * @param null $path
 * @param string $disk
 */
if (!function_exists('deleteOne')) {
    function deleteOne($path = null, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}

if (!function_exists('uploadFileToStorage')) {
    function uploadFileToStorage($file, string $path)
    {
        $file_name = $file->hashName();
        Storage::putFileAs($path, $file,  $file_name);
        return $path . '/' .  $file_name;
    }
}

if (!function_exists('uploadFileToPublic')) {
    function uploadFileToPublic($file, string $path)
    {
        if ($file && $path) {
            $url = $file->move('uploads/' . $path, $file->hashName());
        } else {
            $url = null;
        }

        return $url;
    }
}

// =====================================================
// ===================Env Function====================
// =====================================================

if (!function_exists('setEnv')) {
    function setEnv($key, $value)
    {
        if ($key && $value) {
            $env = new Env();
            $env->setValue($key, $value);
        }

        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
    }
}

if (!function_exists('checkSetEnv')) {
    function checkSetEnv($key, $value)
    {
        if ((env($key) != $value)) {
            setEnv($key, $value);
        }
    }
}

if (!function_exists('haveError')) {
    function haveError($name)
    {
        $errors = session()->get('errors', app(ViewErrorBag::class));
        if ($errors->has($name)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('defaultCurrencySymbol')) {
    function defaultCurrencySymbol()
    {

        return env('APP_CURRENCY_SYMBOL');
    }
}

if (!function_exists('currentLanguage')) {
    function currentLanguage()
    {
        if (session()->has('set_lang')) {
            $lang = Language::where('code', session('set_lang'))->first();
        } else {
            $lang = Language::where('code', env('APP_DEFAULT_LANGUAGE'))->first();
        }

        return $lang;
    }
}

if (!function_exists('allowLaguageChanage')) {
    function allowLaguageChanage()
    {
        $status = Setting::first()->pluck('language_changing');
        if ($status == '[1]') {
            return true;
        } else {
            return false;
        }
    }
}

// return first cookies data
if (!function_exists('cookies')) {
    function cookies()
    {
        return Cookies::first();
    }
}

if (!function_exists('autoTransLation')) {
    function autoTransLation($lang, $text)
    {
        $tr = new GoogleTranslate($lang);
        $afterTrans = $tr->translate($text);
        return $afterTrans;
    }
}

if (!function_exists('inspireMe')) {
    function inspireMe()
    {
        Artisan::call('inspire');
        return Artisan::output();
    }
}

if (!function_exists('getUnsplashImage')) {
    function getUnsplashImage()
    {
        $url = "https://source.unsplash.com/random/1920x1280/?park,mountain,ocean,sunset,travel";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $a = curl_exec($ch); // $a will contain all headers

        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        return $url;
    }
}

if (!function_exists('homePageThemes')) {
    function homePageThemes()
    {
        return Theme::first()->home_page;
    }
}

/**
 * Check module is enabled or not
 *
 * @param string $module_name
 * @return boolean
 */
if (!function_exists('enableModule')) {
    function enableModule(string $module_name)
    {
        try {
            return ModuleSetting::select($module_name)->value($module_name);
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }
}

if (!function_exists('metaData')) {
    function metaData($page)
    {
        return Seo::where('page_slug', $page)->first();
    }
}

if (!function_exists('str_slug')) {
    function str_slug($value)
    {
        return Str::slug($value);
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'Y-m-d')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($date, $format = 'Y-m-d')
    {
        return Carbon::createFromFormat($format, $date);
    }
}

if (!function_exists('currencyConversion')) {
    function currencyConversion($amount, $from = null, $to = null, $round = 2)
    {
        $from = $from ?? config('zakirsoft.currency');
        $to = $to ?? 'USD';

        return Currency::convert()
            ->from($from)
            ->to($to)
            ->amount($amount)
            ->round($round)
            ->get();
    }
}

if (!function_exists('checkMailConfig')) {
    function checkMailConfig()
    {
        $status = config('mail.mailers.smtp.transport') && config('mail.mailers.smtp.host') && config('mail.mailers.smtp.port') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password') && config('mail.mailers.smtp.encryption') && config('mail.from.address') && config('mail.from.name');

        return $status ? 1 : 0;
    }
}
