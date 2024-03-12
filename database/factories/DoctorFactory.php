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
            'doctor_name' => $this->faker->name,
            'doctor_specialist' => $this->faker->word,
            'doctor_phone' => $this->faker->phoneNumber,
            'doctor_email' => $this->faker->email,
            'doctor_photo' => $this->faker->imageUrl(),
            'doctor_address' => $this->faker->address,
            'sip' => $this->faker->numberBetween(1000, 9999),
        ];
    }
}
