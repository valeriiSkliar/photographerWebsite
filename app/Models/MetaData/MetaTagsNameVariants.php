<?php

namespace App\Models\MetaData;

use Illuminate\Database\Eloquent\Model;

class MetaTagsNameVariants extends Model
{
    public function metaTags()
    {
        return $this->hasMany(MetaTags::class, 'type');
    }
}
