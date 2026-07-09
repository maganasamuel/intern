<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>|string|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'image' => ['required'/* , 'image' */, 'max:' . (5 * 1024)],
            /* 'image' => [
                'required',
                'file',
                'mimes:jpg,jpeg,bmp,gif,webp',
                'mimetypes:image/jpeg,image/bmp,image/gif,image/webp',
                'max:' . (5 * 1024),
            ], */
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'Image',
        ];
    }
}
