<?php

namespace App\Models\MetaData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTegType extends Model
{
    use HasFactory;

    public function nameVariant()
    {
        return $this->belongsTo(MetaTagsNameVariants::class, 'type');
    }

    public function propertyVariant()
    {
        return $this->belongsTo(MetaTagsPropertyVariants::class, 'type');
    }
}
