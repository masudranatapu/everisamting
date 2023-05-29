<?php

namespace Modules\Ad\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ad\Entities\Ad;

class AdGalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ad\Entities\AdGallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = rand(30, 600);
        $image = 'https://picsum.photos/id/' . $id . '/700/600';

        return [
            'ad_id' => Ad::inRandomOrder()->first()->id,
            'image' => $image,
        ];
    }
}
