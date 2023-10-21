<?php

namespace Database\Factories\MetaData;

use App\Models\MetaData\MetaTegType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MetaData\MetaTegType>
 */
class MetaTegTypeFactory extends Factory
{
    protected $model = MetaTegType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typies = ['name', 'property'];


        return [
            'type' => $this->faker->unique()->randomElement($typies)
        ];
    }
}
