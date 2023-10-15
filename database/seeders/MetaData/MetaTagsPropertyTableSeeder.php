<?php

namespace Database\Seeders\MetaData;

use App\Models\MetaData\MetaTagsPropertyVariants;
use Illuminate\Database\Seeder;

class MetaTagsPropertyTableSeeder extends Seeder
{
    /**
     * Predefined properties
     * @var string[]
     */
    private array $properties = [
        'og:title',
        'og:type',
        'og:image',
        'og:image:secure_url',
        'og:image:type',
        'og:image:width',
        'og:image:height',
        'og:url',
        'og:description',
        'og:site_name',
        'og:locale',
        'og:locale:alternate',
        'fb:admins',
        'fb:app_id',
        'fb:page_id',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->properties as $item) {
            $model = new MetaTagsPropertyVariants([
                'property' => $item,
            ]);
            $model->save();
        }

    }
}
