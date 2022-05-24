<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:5'],
            'content' => ['required', 'string', 'min:5'],
            'slug' => ['nullable', 'string', 'min:5'],
            'page' => ['required', 'int'],
            'code' => ['nullable', 'int'],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'file_upload' => 'required|max:10000|mimes:pdf,PDF',
        ];
    }
}
