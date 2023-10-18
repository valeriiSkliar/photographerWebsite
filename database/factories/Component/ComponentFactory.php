<?php

namespace Database\Factories\Component;

use App\Models\Album;
use App\Models\Section\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component\Component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->word,
            'section_id' => Section::get()->random()->id,
            'album_id' => Album::get()->random()->id,
            'content' => $this->faker->optional()->paragraphs(3, true),
        ];
    }
}
