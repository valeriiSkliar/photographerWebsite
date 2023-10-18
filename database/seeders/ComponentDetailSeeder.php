<?php

namespace Database\Seeders;

use App\Models\ComponentDetail\ComponentDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComponentDetail::factory(10)->create();

    }
}
