<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pasien_nomor' => fake()->randomNumber(4, true),
            'pasien_nik' => fake()->randomNumber(4, true),
            'pasien_name' => fake()->name(),
            'pasien_age' => fake()->randomNumber(2, true),
            'pasien_address' => fake()->address(),
            'pasien_status' => rand(1, 2),
            'pasien_in' => fake()->date(),
        ];
    }
}
