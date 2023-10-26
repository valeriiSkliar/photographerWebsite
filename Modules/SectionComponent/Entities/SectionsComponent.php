<?php

namespace Modules\SectionComponent\Entities;

use App\Models\Section\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionsComponent extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'data', 'section_id', 'template_name'];
//    protected $guarded = [];


    protected static function newFactory()
    {
        return \Modules\SectionComponent\Database\factories\SectionsComponentFactory::new();
    }

    public function componentData()
    {
        return $this->hasMany(ComponentData::class, 'sections_components_id');
    }

    public function componentDataAble()
    {
        return $this->morphMany(ComponentData::class, 'dataable');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

}
