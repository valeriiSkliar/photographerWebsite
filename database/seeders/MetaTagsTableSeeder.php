<?php

namespace Database\Seeders;

use App\Models\MetaTags;
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
