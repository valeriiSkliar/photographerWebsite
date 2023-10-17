<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
    use HasFactory;

    protected $table = 'album_images';
    protected $guarded = [];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
