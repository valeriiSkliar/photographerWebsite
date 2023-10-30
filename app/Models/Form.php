<?php

namespace App\Models;

use App\Forms\ApplicationForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kris\LaravelFormBuilder\FormBuilder;
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

    public static function getFormTemplate ($formId, FormBuilder $formBuilder) {

        return $formTemplate = $formBuilder->create(ApplicationForm::class, [
            'data' => ['formId' => $formId]
        ]);
    }
}
