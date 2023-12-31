<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PagesFactory extends Factory
{
    protected $model = Page::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pages = ['Main', 'About', 'Portfolio', 'Work', 'Contact'];

        $title = $this->faker->sentence(4);
        $name = $this->faker->unique()->randomElement($pages);
        $slug = strtolower(str_replace(' ', '-', $name));

        return [
            'name' => $name,
            'slug' => $slug,
            'title' => $title . ' ' . $name,
            'meta_data' => 'meta_data',
        ];
    }
}
