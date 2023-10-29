<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SectionComponent\Entities\ComponentData;

class Form extends Model
{
    use HasFactory;

    public function componentData()
    {
        return $this->morphMany(ComponentData::class, 'dataable');
    }
}
