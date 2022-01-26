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
            'hours' => $this->faker->numberBetween(1, 300),
            'minutes' => $this->faker->numberBetween(1, 60),
            'seconds' => $this->faker->numberBetween(1, 60),
        ];
    }
}
