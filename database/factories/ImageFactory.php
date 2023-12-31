<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_url' => fake()->imageUrl(),
            'rank' => fake()->randomNumber(2),
            'alt_text' => fake()->sentence(2),
            'title' => fake()->sentence(2),
        ];
    }
}
