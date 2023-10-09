<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function coverImage()
    {
        return $this->belongsTo(Image::class, 'cover_image_id');
    }
}
