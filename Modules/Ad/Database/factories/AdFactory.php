<?php

namespace Modules\Ad\Database\factories;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ad\Entities\Ad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = rand(10, 600);
        $title = $this->faker->sentence($nbWords = 3, $variableNbWords = true);
        $image = 'https://picsum.photos/id/' . $id . '/700/600';

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'subcategory_id' => SubCategory::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'price' => rand(100, 550),
            'description' => $this->faker->paragraph,
            'phone' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->phoneNumber,
            'thumbnail' => $image,
            'status' => Arr::random(["active", "sold", 'pending', 'declined']),
            'featured' => rand(true, false),
            'total_reports' => rand(1, 30),
            'total_views' => rand(1, 300),
            'is_blocked' => rand(true, false),
            'country' => $this->faker->country(),
            'lat' => $this->faker->latitude(-90, 90),
            'long' => $this->faker->longitude(-90, 90),
            'whatsapp' => Arr::random(['', "https://web.whatsapp.com"])
        ];
    }
}
