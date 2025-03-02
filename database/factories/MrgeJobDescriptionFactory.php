<?php

namespace Database\Factories;

use App\Models\MrgeJob;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MrgeJobDescription>
 */
class MrgeJobDescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Looking for an exciting challenge?',
                'Your Tasks',
                'Your Profile',
                'Your Opportunity',
            ]),
            'value' => fake()->paragraph(),
            'mrge_job_id' => MrgeJob::factory(),
        ];
    }
}
