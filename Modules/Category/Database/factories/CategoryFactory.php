<?php

namespace Modules\Category\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Category\Entities\Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = rand(1, 300);
        $image = 'https://picsum.photos/id/' . $id . '/700/600';
        $title = $this->faker->word(1);

        return [
            'name' => $title,
            'image' => $image,
            'icon' => Arr::random(['far fa-grin-tongue-wink', 'far fa-laugh-beam', 'far fa-laugh-wink', 'far fa-smile-beam', 'far fa-smile-wink', 'far fa-angry', 'far fa-meh-rolling-eyes', 'far fa-grin-tongue-squint', 'far fa-frown', 'far fa-smile', 'far fa-meh', 'far fa-grin-tongue-wink', 'far fa-laugh-beam', 'far fa-laugh-wink', 'far fa-smile-beam', 'far fa-smile-wink', 'far fa-angry', 'far fa-meh-rolling-eyes', 'far fa-grin-tongue-squint', 'far fa-frown', 'far fa-smile', 'far fa-meh']),
            'slug' => Str::slug($title),
        ];
    }
}
