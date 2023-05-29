<?php

namespace Modules\Blog\Database\factories;

use App\Models\Admin;
use Illuminate\Support\Str;
use Modules\Blog\Entities\PostCategory;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Blog\Entities\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = rand(30, 600);
        $image = 'https://picsum.photos/id/' . $id . '/700/600';
        $title = $this->faker->sentence($nbWords = 5, $variableNbWords = true);
        return [
            'category_id' => PostCategory::inRandomOrder()->value('id'),
            'author_id' => Admin::inRandomOrder()->value('id'),
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => $image,
            'short_description' => $this->faker->sentence(40),
            'description' => $this->faker->paragraph(200),
        ];
    }
}
