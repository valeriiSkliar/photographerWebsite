<?php

namespace App\Models;

use App\Models\ComponentDetail\ComponentDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentDetailTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'component_detail_id',
        'locale',
        'translated_value',
    ];

    public function componentDetail(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ComponentDetail::class);
    }
}
