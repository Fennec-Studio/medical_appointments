<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'speciality_id' => $this->faker->numberBetween(1, 2),
            'room' => $this->faker->numberBetween(1, 100),
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'phone' => $this->faker->unique()->phoneNumber,
            'license' => $this->faker->word,
        ];
    }
}
