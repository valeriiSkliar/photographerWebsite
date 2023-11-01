<?php

namespace App\Models\Component;

use App\Models\Album;
use App\Models\ComponentDetail\ComponentDetail;
use App\Models\Page;
use App\Models\Section\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pages()
    {
        return $this->belongsTo(Page::class);
    }
    public function details()
    {
        return $this->hasMany(ComponentDetail::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
