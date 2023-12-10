<?php

namespace App\Models;

use App\Models\Component\Component;
use App\Models\MetaData\MetaTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'title', 'meta_data'];

    public function components(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Component::class, 'component_page')
            ->withPivot('order')
            ->orderBy('pivot_order');    }

    public function meta_tags(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MetaTags::class, 'page_id');
    }
}
