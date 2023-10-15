<?php

namespace Database\Seeders\MetaData;

use App\Models\MetaData\MetaTagsNameVariants;
use Illuminate\Database\Seeder;

class MetaTagsNameTableSeeder extends Seeder
{
    /**
     * Predefined names
     * @var string[]
     */
     public array $names = [
            'description',
            'keywords',
            'robots',
            'google-site-verification',
            'revisit-after',
            'generator',
            'googlebot',
            'mssmarttagspreventparsing',
            'no-cache',
            'google',
            'googlebot-news',
            'verify-v1',
            'rating',
            'department',
            'audience',
            'doc_status',
            'twitter:title',
            'twitter:site',
            'twitter:image',
            'twitter:image:alt',
            'twitter:description',
            'twitter:card',
            'twitter:url'
     ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach ($this->names as $variant) {

            foreach ($this->names as $item) {
                $model = new MetaTagsNameVariants([
                    'name' => $item,
                ]);
                $model->save();
            }
        }
    }
}
