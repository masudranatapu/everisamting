<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SocialMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 3),
            'social_media' => $this->faker->randomElement(['facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'pinterest', 'reddit', 'github', 'website', 'other']),
            'url' => $this->faker->url,
        ];
    }
}
