<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Emplyer>
 */
class EmplyerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            [
                'name' => 'Rabii Farakh',
                'email' => 'rabiifarakh@gmail.com',
                'password' => 'rabiifarakh@gmail.com',
            ],
            [
                'name' => 'Salah Akil',
                'email' => 'akilsalah@gmail.com',
                'password' => 'akilsalah@gmail.com',
            ],
            [
                'name' => 'Mohammed Ghollam',
                'email' => 'ghollam@gmail.com',
                'password' => 'ghollam@gmail.com',
            ],
        ];
    }
}
