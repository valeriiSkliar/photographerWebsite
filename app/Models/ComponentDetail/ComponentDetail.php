<?php

namespace App\Models\ComponentDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['component_id', 'key', 'value'];
}
