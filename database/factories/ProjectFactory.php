<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Time;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure() {
        return $this->afterCreating(function(Project $project) {
            $project->times()
                ->saveMany(Time::factory(3)->make());
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'name' => $this->faker->name,
        ];
    }
}
