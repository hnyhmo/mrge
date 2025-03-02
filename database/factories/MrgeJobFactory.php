<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MrgeJob>
 */
class MrgeJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'office' => fake()->address(),
            'department' => fake()->randomLetter(),
            'recruitingCategory' => fake()->randomLetter(),
            'subcompany' => fake()->company(),
            'employmentType' => fake()->randomLetter(),
            'seniority' => fake()->randomLetter(),
            'schedule' => fake()->randomLetter(),
            'yearsOfExperience' => fake()->year(),
            'keywords' => fake()->paragraph(),
            'occupation' => fake()->randomLetter(),
            'occupationCategory' => fake()->randomLetter(),
        ];
    }
}
