<?php

namespace Database\Factories\ComponentDetail;

use App\Models\Component\Component;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComponentDetail\ComponentDetail>
 */
class ComponentDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->word,
            'value' => $this->faker->sentence,
            'component_id' => Component::get()->random()->id,
        ];
    }
}
