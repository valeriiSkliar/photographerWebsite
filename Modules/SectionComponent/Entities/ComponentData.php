<?php

namespace Modules\SectionComponent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComponentData extends Model
{
    use HasFactory;

    protected $table = 'component_data';

    protected $fillable = ['field_name', 'field_value', 'sections_components_id'];

    protected static function newFactory()
    {
        return \Modules\SectionComponent\Database\factories\ComponentDataFactory::new();
    }

    public function component()
    {
        return $this->belongsTo(SectionsComponent::class, 'component_id');
    }

}
