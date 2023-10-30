<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SectionComponent\Entities\ComponentData;

/**
 * @property mixed $id
 */
class Form extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function form_fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function componentData()
    {
        return $this->morphMany(ComponentData::class, 'dataable');
    }

    public static function getIdNameArray()
    {
        return self::pluck('name', 'id')->toArray();
    }
}
