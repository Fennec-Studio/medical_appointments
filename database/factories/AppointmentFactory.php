<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->numberBetween(1, 10),
            'doctor_id' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'comments' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 1)
        ];
    }
}
