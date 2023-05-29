<?php

namespace Modules\Plan\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Modules\Plan\Entities\Plan;

class PriceplanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => Arr::random(['yearly', 'monthly']),
            'label' => $this->faker->sentence(1),
            'price' => rand(10, 99),
            'ad_limit' => rand(10, 99),
            'business_directory_limit' => rand(10, 99),
            'description' => $this->faker->sentence(1),
            'status' => rand(0, 1),
            'featured' => rand(0, 1),
            'badge' => rand(0, 1),
            'validity' => rand(0, 1),
            'membership' => rand(0, 1),
            'advertise' => rand(0, 1),
        ];
    }
}
