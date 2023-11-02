<?php

namespace App\Models;

use App\Models\MetaData\MetaTags;
use App\Models\Section\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'title', 'meta_data'];

    public function components()
    {
        return $this->belongsToMany(Component::class);
    }
//    public function sections()
//    {
//        return $this->hasMany(Section::class, 'page_id');
//    }

    public function meta_tags()
    {
        return $this->hasMany(MetaTags::class, 'page_id');
    }
}
