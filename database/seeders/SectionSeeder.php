<?php

namespace Database\Seeders;

use App\Models\Section\Section;
use App\Models\SectionContent;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::factory(2)->create();

        SectionContent::factory(2)->create();
    }
}
