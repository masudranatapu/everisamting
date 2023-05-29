<?php

namespace Modules\Plan\Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Modules\Plan\Entities\Plan;
use Illuminate\Database\Eloquent\Model;

class PlanDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $is_recurring = Setting::first()->subscription_type == 'recurring' ? 1 : 0;

        $plans = [
            [
                'label' => 'Basic',
                'price' => '10',
                'ad_limit' => '5',
                'featured_limit' => '2',
                'business_directory_limit' => '2',
                'badge' => false,
                'recommended' => false,
                'interval' => $is_recurring ? 'monthly' : '',
            ],
            [
                'label' => 'Standard',
                'price' => '20',
                'ad_limit' => '15',
                'featured_limit' => '5',
                'business_directory_limit' => '5',
                'badge' => true,
                'recommended' => true,
                'interval' => $is_recurring ? 'yearly' : '',
            ],
            [
                'label' => 'Premium',
                'price' => '50',
                'ad_limit' => '60',
                'featured_limit' => '20',
                'business_directory_limit' => '20',
                'badge' => true,
                'recommended' => false,
                'interval' => $is_recurring ? 'custom_date' : '',
                'custom_interval_days' => '15',
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
