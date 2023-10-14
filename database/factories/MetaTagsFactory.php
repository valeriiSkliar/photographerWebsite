<?php

namespace Database\Factories;

use App\Models\MetaData\MetaTagsNameVariants;
use App\Models\MetaData\MetaTagsPropertyVariants;
use App\Models\MetaTags;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetaTagsFactory extends Factory
{
    protected $model = MetaTags::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['name', 'property']);
        $value = null;

        if ($type === 'name') {
            $name_model = MetaTagsNameVariants::inRandomOrder()->first();
            $value = $name_model?->name;
        } elseif ($type === 'property') {
            $property_model = MetaTagsPropertyVariants::inRandomOrder()->first();
            $value = $property_model ? $property_model->property : null;
        }

        return [
            'content' => $this->faker->sentence(5),
            'type' => $type,
            'page_id' => $this->faker->numberBetween(1,5),
            'value' => $value,
        ];
    }
}
