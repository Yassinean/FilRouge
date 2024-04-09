<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name,
            'user_id' => 1,
            'type_job_id' => rand(1, 5),
            'category_job_id' => rand(1, 5),
            'vacancy' => rand(1, 5),
            'location' => fake()->city,
            'description' => fake()->text,
            'responsabitilies' => fake()->text,
            'qualifications' => fake()->text,
            'keywords' => fake()->text,
            'experiences' => rand(1, 10),
            'company_name' => fake()->name,
        ];
    }
}
