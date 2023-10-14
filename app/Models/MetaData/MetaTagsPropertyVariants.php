<?php

namespace App\Models\MetaData;

use App\Models\MetaTags;
use Illuminate\Database\Eloquent\Model;

class MetaTagsPropertyVariants extends Model
{
    public function metaTags()
    {
        return $this->hasMany(MetaTags::class, 'type');
    }
}
