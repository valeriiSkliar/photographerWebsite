<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AlbumsTableSeeder::class);

        $this->call(MetaTagsNameTableSeeder::class);
        $this->call(MetaTagsPropertyTableSeeder::class);
        $this->call(MetaTagsTableSeeder::class);

    }
}
