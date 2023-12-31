<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AiModel>
 */
class AiModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numberOfWords = fake()->numberBetween(2, 4);
        $name = 'Model' . fake()->unique()->words($numberOfWords, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'model_url' => fake()->url(),
        ];
    }
}
