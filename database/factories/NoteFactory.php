<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'note_date' => $this->faker->dateTimeThisMonth(),
            'pasien_id' => $this->faker->numberBetween(1, 10), // Assuming you have 100 patients
            'note_category' => $this->faker->numberBetween(1, 9),
            'note_name' => $this->faker->word(),
            'note_price' => $this->faker->numberBetween(1000, 100000),
        ];
    }
}
