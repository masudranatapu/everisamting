<?php

namespace Modules\MobileApp\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\MobileApp\Entities\MobileAppConfig;

class MobileAppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        MobileAppConfig::create([
            'android_download_url' => 'https://play.google.com/store/apps/details?id=com.app.appname',
            'ios_download_url' => 'https://apps.apple.com/us/app/app-name/id1440990079',
            'privacy_url' => 'https://www.appname.com/privacy-policy',
            'support_url' => 'https://www.appname.com/support',
            'terms_and_condition_url' => 'https://www.appname.com/terms-and-conditions',
        ]);
    }
}
