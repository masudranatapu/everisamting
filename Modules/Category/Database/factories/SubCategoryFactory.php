<?php
namespace Modules\Category\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
Use Illuminate\Support\Str;
use Modules\Category\Entities\Category;

class SubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Category\Entities\SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
        ];
    }
}

