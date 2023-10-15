<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section\Section>
 */
class SectionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pages = ['Main', 'About', 'Portfolio', 'Work', 'Contact'];

        $sections = [
            'main' => [ 'section_1', 'section_2', 'section_3' ],
            'about' => ['section_1', 'section_2', 'section_3'],
            'portfolio' => ['section_1'],
            'work' => ['section_1', 'section_2', 'section_3', 'section_4', 'section_5'],
            'contact' => ['section_1'],
        ];

        $page_title = $this->faker->unique()->randomElement($pages);
        $key = strtolower(str_replace(' ', '-', $page_title));

        return [
            //
        ];
    }
}
