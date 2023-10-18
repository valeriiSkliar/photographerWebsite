<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumImage;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function PHPUnit\TestFixture\func;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Album::factory(5)
            ->create();

        Image::factory(100)
            ->create();

        AlbumImage::factory(50)
            ->create();
    }
}
