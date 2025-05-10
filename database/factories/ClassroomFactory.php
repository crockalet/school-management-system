<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->numberBetween(1,12).$this->faker->randomElement(['A' ,'B', 'C', 'D']),
            'section' => $this->faker->word(),
            'max_students' => $this->faker->optional()->numberBetween(20, 40),
        ];
    }
}
