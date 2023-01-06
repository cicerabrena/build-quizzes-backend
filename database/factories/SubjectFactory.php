<?php

namespace Database\Factories;

use Illuminate\Support\Str;

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
        $slug = Str::slug($name, '-');

        return [
            'identification' => $this->faker->uuid(),
            'name' => $name,
            'slug' => $slug,
            'created_at' => now()
        ];
    }
}
