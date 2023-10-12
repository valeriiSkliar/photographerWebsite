<?php

namespace Database\Factories;

use App\Models\MetaTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Carbon;

class PropertyMetaTagFactory extends Factory
{
    protected $model = MetaTag::class;

    public function definition(): array
    {
            return [
                'content' => $this->faker->words(10, true),
                'name' => null,
                'property' => $this->faker->randomElement(MetaTag::PREDEFINED_PROPERTY),
                'http-equiv' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

    }
}
