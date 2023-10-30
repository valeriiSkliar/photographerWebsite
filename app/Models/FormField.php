<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function form_fields()
    {
        return $this->belongsTo(Form::class);
    }
}
