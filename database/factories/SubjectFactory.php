<?php

namespace Database\Factories;

use App\Enums\SubjectValidationNumbers;
use App\Models\User;
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
        $slug = Str::slug(title: $name, separator: '-');

        $user = User::factory()->create();

        return [
            'identification' => $this->faker->uuid(),
            'user_id' => $user->id,
            'name' => $name,
            'slug' => Str::limit(value: $slug, limit: SubjectValidationNumbers::MAX_LENGTH_SLUG->value, end: ''),
            'description' => $this->faker->text(SubjectValidationNumbers::MAX_LENGTH_DESCRIPTION_NAME->value),
            'created_at' => now(),
        ];
    }
}
