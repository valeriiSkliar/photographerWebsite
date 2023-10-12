<?php

namespace Database\Seeders;

use App\Models\MetaTag;

use Database\Factories\PropertyMetaTagFactory;
use Illuminate\Database\Seeder;

class MetaTagsSeeder extends Seeder
{
    public function run(): void
    {
        $length_name = count(MetaTag::PREDEFINED_NAMES);
        $length_property = count(MetaTag::PREDEFINED_PROPERTY);

        $all_meta_by_names = MetaTag::factory($length_name)
        ->create();
        $all_meta_by_property = MetaTag::factory(PropertyMetaTagFactory::class)
            ->times($length_property)
            ->create();

        foreach ($all_meta_by_names as $name) {
            $name->save();
        }
        foreach ($all_meta_by_property as $property) {
            $property->save();
        }
    }
}
