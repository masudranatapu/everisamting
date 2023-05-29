<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'report_from_id' => User::inRandomOrder()->value('id'),
            'report_to_id' => User::inRandomOrder()->value('id'),
            'reason' => $this->faker->text,
        ];
    }
}
