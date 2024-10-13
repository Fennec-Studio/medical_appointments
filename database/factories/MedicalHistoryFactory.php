<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medical_History>
 */
class MedicalHistoryFactory extends Factory
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
            'age' => $this->faker->numberBetween(1, 90),
            'gender' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'height' => $this->faker->randomFloat(2, 1, 2),
            'weight' => $this->faker->randomFloat(2, 1, 2),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'allergies' => $this->faker->randomElement(['Ninguna', 'Polen', 'Polvo', 'Ácaros', 'Alimentos', 'Medicamentos']),
            'medications' => $this->faker->randomElement(['Ninguna', 'Paracetamol', 'Ibuprofeno', 'Aspirina', 'Amoxicilina', 'Diclofenaco']),
        ];
    }
}
