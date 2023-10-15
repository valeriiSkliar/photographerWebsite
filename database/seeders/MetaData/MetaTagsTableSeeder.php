<?php

namespace Database\Seeders\MetaData;

use App\Models\MetaData\MetaTags;
use Illuminate\Database\Seeder;

class MetaTagsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MetaTags::factory(30)->create();
    }
}
