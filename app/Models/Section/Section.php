<?php

namespace App\Models\Section;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'name', 'order'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
