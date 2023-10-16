<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    Use SoftDeletes;

    protected $guarded =[];

//    public function album()
//    {
//        return $this->belongsTo(Album::class);
//    }
}
