<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->name();
        $slug = str($name)->replace(" ", "-");

        return [
            'identification' => $this->faker->uuid(),
            'name' => $name,
            'slug' => $slug,
            'created_at' => now()
        ];
    }
}
