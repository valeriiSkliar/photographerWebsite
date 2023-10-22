<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\MetaData\MetaTagsNameTableSeeder;
use Database\Seeders\MetaData\MetaTagsPropertyTableSeeder;
use Database\Seeders\MetaData\MetaTagsTableSeeder;
use Database\Seeders\MetaData\MetaTagTypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PagesSeeder::class);
        $this->call(AlbumsTableSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ComponentSeeder::class);
        $this->call(ComponentDetailSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(MetaTagTypeSeeder::class);
        $this->call(MetaTagsNameTableSeeder::class);
        $this->call(MetaTagsPropertyTableSeeder::class);
        $this->call(MetaTagsTableSeeder::class);

    }
}
