<?php

namespace Database\Factories;

use App\Models\Section\Section;
use App\Models\SectionComponent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SectionComponent>
 */
class SectionContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'section_id' => Section::get()->unique()->random()->id,
//            'font' => $this->faker->randomElement(['Arial', 'Verdana', 'Times New Roman', 'Tahoma']),
//            'font_color' => $this->faker->hexColor,
//            'background_color' => $this->faker->hexColor,
//            'background_image' => $this->faker->imageUrl(640, 480, 'nature'),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'content_text' => $this->faker->optional()->paragraphs(3, true),
        ];
    }
}
