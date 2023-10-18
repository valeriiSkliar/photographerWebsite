<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlbumImage>
 */
class AlbumImageFactory extends Factory
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
            'image_id' => Image::get()->random()->id,
        ];
    }
}
