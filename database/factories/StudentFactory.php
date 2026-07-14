<?php

namespace Database\Factories;

use App\Enums\StudentStatus;
use App\Models\{Course, Student};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->randomElement(['male', 'female']),
            'dob' => fake()->dateTimeBetween('-60 years', '-30 years'),
            'address' => fake()->address(),
            'contact_number' => fake()->numerify('+639#########'),
            'email' => fake()->unique()->safeEmail(),
            'scholarship_accredited' => fake()->boolean(),
            'status' => fake()->randomElement(StudentStatus::cases()),
        ];
    }
}
