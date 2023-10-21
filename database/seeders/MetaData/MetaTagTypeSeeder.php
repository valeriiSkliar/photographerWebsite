<?php

namespace Database\Seeders\MetaData;

use App\Models\MetaData\MetaTegType;
use Illuminate\Database\Seeder;

class MetaTagTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MetaTegType::factory(2)->create();
    }
}
