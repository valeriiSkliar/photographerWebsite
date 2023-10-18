<?php

namespace Database\Seeders;

use App\Models\Component\Component;
use App\Models\ComponentDetail\ComponentDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Component::factory(10)->create();
    }
}
