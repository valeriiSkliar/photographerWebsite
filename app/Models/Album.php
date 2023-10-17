<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'album_images');
    }
    public function components()
    {
        return $this->hasMany(\App\Models\Component\Component::class);
    }

}
