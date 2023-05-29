<?php


use App\Models\Setting;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\ModuleSetting;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Artisan;
use Modules\Category\Entities\Category;
use Modules\Language\Entities\Language;
use Modules\Wishlist\Entities\Wishlist;
use App\Notifications\LoginNotification;
use Modules\SetupGuide\Entities\SetupGuide;
use Stichoza\GoogleTranslate\GoogleTranslate;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Modules\Currency\Entities\Currency as CurrencyModel;

function setting($fields = null, $append = false)
{
    if ($fields) {
        $type = gettype($fields);

        if ($type == 'string') {
            $data = $append ? Setting::first($fields) : Setting::value($fields);
        } elseif ($type == 'array') {
            $data = Setting::first($fields);
        }
    } else {
        $data = Setting::first();
    }

    if ($append) {
        $data = $data->makeHidden(['logo_image_url', 'logo2_image_url', 'favicon_image_url', 'loader_image_url']);
    }

    return $data;
}

/**
 * Check ad is wishlisted
 *
 * @param integer $adId
 * @return boolean
 */
function isWishlisted($adId)
{
    if (auth()->guard('user')->check() && session()->has('wishlists') && in_array($adId, session('wishlists'))) {
        return true;
    }

    return false;
}

/**
 * Store customer plan information to session storage
 *
 * @return void
 */
function storePlanInformation()
{
    session()->forget('user_plan');
    session()->put('user_plan', auth()->guard('user')->user()->userPlan ?? auth()->guard('api')->user()->userPlan);
}

function socialMediaShareLinks(string $path, string $provider)
{
    switch ($provider) {
        case 'facebook':
            $share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $path;
            break;
        case 'twitter':
            $share_link = 'https://twitter.com/intent/tweet?text=' . $path;
            break;
        case 'linkedin':
            $share_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $path;
            break;
        case 'gmail':
            $share_link = 'https://mail.google.com/mail/u/0/?ui=2&fs=1&tf=cm&su=' . $path;
            break;
        case 'whatsapp':
            $share_link = 'https://wa.me/?text=' . $path;
            break;
    }

    return $share_link;
}

/**
 * Get is category menu selected
 *
 * @param Category $category
 *
 * @return boolean
 */
function isActiveCategorySidebar($category)
{
    $found = false;

    $categorySubcatategories = $category->subcategories->pluck('slug')->all();
    $urlSubCategories = request('subcategory', []);

    foreach ($categorySubcatategories as $category) {
        if (in_array($category, $urlSubCategories)) {
            $found  = true;
            break;
        }
    }

    return $found;
}


// function homePageThemes()
// {
//     return Theme::first()->home_page;
// }

function collectionToResource($data)
{
    return json_decode(json_encode($data), false);
}

/**
 * Store customer wishlists information to session storage
 *
 * @return void
 */
function resetSessionWishlist()
{
    session()->forget('wishlists');
    $wishlists =  Wishlist::select(['ad_id'])->where('user_id', auth()->guard('user')->id())->pluck('ad_id')->all();

    session()->put('wishlists', $wishlists);
}

/**
 * Send logged in notification
 *
 * @return void
 */
function loggedinNotification()
{
    $user = User::find(auth('user')->id());
    if (checkSetup('mail')) {
        $user->notify(new LoginNotification($user));
    }
}

/**
 * customer has mambership badge or not
 *
 * @param int $user_id
 * @return bool
 */
function hasMemberBadge($user_id)
{
    return UserPlan::where('user_id', $user_id)->first()->badge;
}

/**
 * user permission check
 *
 * @param string $permission
 * @return boolean
 */
function userCan($permission)
{
    if (auth('admin')->check()) {
        return auth('admin')->user()->can($permission);
    }

    return false;
}

/**
 * user permission check
 *
 * @param string $permission
 * @return boolean
 */
function envReplace($name, $value)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            $name . '=' . env($name),
            $name . '=' . $value,
            file_get_contents($path)
        ));
    }

    if (file_exists(App::getCachedConfigPath())) {
        Artisan::call("config:cache");
    }
}

function langDirection()
{
    $lang_code = app()->getLocale();
    $lang_direction = Language::where('code', $lang_code)->value('direction');

    return $lang_direction;
}

function error($name)
{
    $errors = session()->get('errors', app(ViewErrorBag::class));

    return $errors->has($name) ? 'is-invalid' : '';
}

function convertCurrency($amount, $last_digit = 2)
{
    if ($amount) {
        $amount = CurrencyModel::where('code', config('adlisting.currency'))->value('exchange_rate') * $amount;
    }

    return number_format($amount, $last_digit, '.', ',');
}

function convertCurrency2($amount)
{
    return (int) Currency::convert()
        ->from('USD')
        ->to(config('adlisting.currency'))
        ->amount($amount)
        ->round(2)
        ->get();
}

function currencyFormatting($amount)
{
    $currency = session('current_currency');
    $converted_amount = $amount;

    if ($currency->symbol_position == 'left') {
        return "$currency->symbol$converted_amount";
    } else {
        return "$converted_amount$currency->symbol";
    }
}

function changeCurrency($amount)
{
    $symbol = config('adlisting.currency_symbol');
    $position = config('adlisting.currency_symbol_position');

    if ($position == 'left') {
        return $symbol . ' ' . $amount;
    } else {
        return $amount . ' ' . $symbol;
    }

    return $amount;
}

function getFileSize($file)
{
    $file_exists = file_exists($file);

    if ($file_exists) {
        return File::size($file);
    }

    return 0;
}

function setup_guide($slug)
{
    $guide = SetupGuide::where('slug', $slug)->first();
    return $guide;
}

function setup_guides()
{
    return SetupGuide::all()->each(function ($item) {
        if ($item->slug == 'mail-setup') {
            $mail_status = env('MAIL_MAILER') && env('MAIL_HOST') && env('MAIL_PORT') && env('MAIL_USERNAME') && env('MAIL_PASSWORD') && env('MAIL_ENCRYPTION') && env('MAIL_FROM_ADDRESS') && env('MAIL_FROM_NAME');

            $item->status = $mail_status ? 1 : 0;
        } elseif ($item->slug == 'payment-setup') {
            $payment_settings = PaymentSetting::first();

            $payment_status = $payment_settings->paypal || $payment_settings->stripe || $payment_settings->razorpay || $payment_settings->paystack || $payment_settings->ssl_commerz;


            $item->status = $payment_status ? 1 : 0;
        }
    });
}

function checkSetup($type)
{
    switch ($type) {
        case 'mail':
            $status = env('MAIL_MAILER') && env('MAIL_HOST') && env('MAIL_PORT') && env('MAIL_USERNAME') && env('MAIL_PASSWORD') && env('MAIL_ENCRYPTION') && env('MAIL_FROM_ADDRESS') && env('MAIL_FROM_NAME');
            break;
        case 'payment':
            $payment_settings = PaymentSetting::first();
            $status = $payment_settings->paypal || $payment_settings->stripe || $payment_settings->razorpay || $payment_settings->paystack || $payment_settings->ssl_commerz;
            break;
    }

    return $status ? 1 : 0;
}
