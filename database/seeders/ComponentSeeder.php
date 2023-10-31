<?php

namespace Database\Seeders;

use App\Models\Component\Component;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Component::factory(2)->create();
    }
}
