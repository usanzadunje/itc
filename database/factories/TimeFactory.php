<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'time_spent' => rand(1, 300) . ':' . rand(1, 60) . ':' . rand(1, 60),
        ];
    }
}
