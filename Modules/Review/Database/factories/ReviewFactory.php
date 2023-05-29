<?php

namespace Modules\Review\Database\factories;

use App\Models\User;
use Illuminate\Support\Arr;
use Modules\Order\Entities\Order;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ad\Entities\Ad;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Review\Entities\Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'stars' => Arr::random(['1', '2', '3', '4', '5']),
            'comment' => $this->faker->paragraph,
        ];
    }
}
