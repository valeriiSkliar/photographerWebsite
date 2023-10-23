<?php

namespace App\Models\MetaData;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTags extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(MetaTegType::class, 'type_id');
    }


    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
