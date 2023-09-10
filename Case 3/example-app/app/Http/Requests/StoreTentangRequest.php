<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTentangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image'         => 'required|image|max:1024|mimes:jpg,jpeg,png',
            'name'          => 'required|string|min:3|max:6000',
            'description'       => 'required|string|min:3|max:6000',
        ];
    }
}
