<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetaTagsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => [ 'required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'page_id' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
