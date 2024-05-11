<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => 'required|unique:posts|min:3',
            'body' => 'required|min:10',
            'creator' => [
                'required',
                Rule::exists('mysql.users','id')
            ],
            'image' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'title.unique' => 'this title is already exists',
            'title.min' => 'min characters is 3',
            'body.required' => 'A body is required',
            'creator.exists' => 'this creator doesn\'t exist',
            'image.required' => 'please select image'
        ];
    }
}
