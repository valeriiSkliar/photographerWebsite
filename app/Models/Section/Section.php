<?php

namespace App\Models\Section;

use App\Models\Album;
use App\Models\Component\Component;
use App\Models\Page;
use App\Models\SectionContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name','page_id', 'order'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function sectionContent()
    {
        return $this->hasOne(SectionContent::class);
    }
    public function components()
    {
        return $this->hasMany(Component::class);
    }
    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
