<?php

namespace App\Models\ComponentDetail;

use App\Models\ComponentDetailTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function translations()
    {
        return $this->hasMany(ComponentDetailTranslation::class);
    }

    public function getLocalizedTranslation()
    {
        $locale = app()->getLocale();
        $translation = $this->translations()->where('locale', $locale)->first();
        return $translation ? $translation->translated_value : $this->value;
    }
}
