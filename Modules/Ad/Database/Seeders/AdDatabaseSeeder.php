<?php

namespace Modules\Ad\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Entities\AdFeature;
use Modules\Ad\Entities\AdGallery;

class AdDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Ad::factory(100)->create()->each(function ($ad) {
            AdFeature::factory(5)->create();
            AdGallery::factory(5)->create();
        });


        // $ads = Ad::factory(10000)->make();

        // $chunks = $ads->chunk(2000);

        // $chunks->each(function ($chunk) {
        //     Ad::insert($chunk);
        // });





        // Ad::factory(500)->create()->each(function ($ad, Faker $faker) {
        //     AdFeature::factory(10)->create([
        //         'ad_id' => $ad->id,
        //         'name' => $faker->name,
        //     ]);

        //     AdGallery::factory(5)->create([
        //         'ad_id' => $ad->id,
        //         'image' => $faker->imageUrl(700, 600),
        //     ]);
        // });

        // Ad::factory(1000)->create();
        // AdGallery::factory(1000)->create();
        // AdFeature::factory(200)->create();
    }
}
