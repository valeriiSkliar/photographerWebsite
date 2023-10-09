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
            'album_id' => Album::get()->random()->id,
            'file_url' => fake()->imageUrl(),
            'title' => fake()->sentence(2),
            'metadata' => fake()->sentence(6),
            'rank' => fake()->randomNumber(2),
            'page_id' => fake()->randomNumber(2),
        ];
    }
}
