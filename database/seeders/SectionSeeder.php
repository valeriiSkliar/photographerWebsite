<?php

namespace Database\Seeders;

use App\Models\Section\Section;
use App\Models\SectionContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::factory(10)->create();

        SectionContent::factory(10)->create();
    }
}
