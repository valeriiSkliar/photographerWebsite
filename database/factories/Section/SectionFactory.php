<?php

namespace Database\Factories\Section;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page_id' => Page::get()->random()->id,
            'name' => $this->faker->word,
            'order' => $this->faker->numberBetween(1, 5),
        ];
    }
}
