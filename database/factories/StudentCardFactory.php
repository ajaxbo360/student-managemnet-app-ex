<?php

namespace Database\Factories;

use App\Enums\SchoolEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentCard>
 */
class StudentCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school' => fake()->randomElement(SchoolEnum::class),
            'description' => fake()->sentence(),
            'is_internal' => fake()->boolean(),
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-11 years')->format('Y-m-d'),
            'user_id' => User::factory(),
        ];
    }
}
