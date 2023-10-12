<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetaTagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required'],
            'name' => ['nullable'],
            'property' => ['nullable'],
            'http-equiv' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
