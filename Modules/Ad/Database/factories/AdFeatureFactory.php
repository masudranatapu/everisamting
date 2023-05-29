<?php

namespace Modules\Ad\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ad\Entities\Ad;

class AdFeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ad\Entities\AdFeature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ad_id' => Ad::inRandomOrder()->first()->id,
            'name' => $this->faker->title,
        ];
    }
}
