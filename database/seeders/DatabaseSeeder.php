<?php

namespace Database\Seeders;

use App\Models\ModuleSetting;
use Database\Seeders\SeoSeeder;
use Illuminate\Database\Seeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Currency\Database\Seeders\CurrencyDatabaseSeeder;
use Modules\Language\Database\Seeders\LanguageDatabaseSeeder;
use Modules\MobileApp\Database\Seeders\MobileAppConfigSeeder;
use Modules\SetupGuide\Database\Seeders\SetupGuideDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolePermissionSeeder::class,
            SettingSeeder::class,
            UserSeeder::class,
            MobileAppConfigSeeder::class,
            CurrencyDatabaseSeeder::class,
            LanguageDatabaseSeeder::class,
            SetupGuideDatabaseSeeder::class,
            CookiesSeeder::class,
            SeoSeeder::class,
            CmsSeeder::class,
        ]);
    }
}
