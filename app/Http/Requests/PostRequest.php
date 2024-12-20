<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required|string',
            'summary'=>'required',
            'image'=>'mimes:jpeg,jpg,png,gif',
        ];
    }
    public function messages()
    {
        return [
            'title.string'=>__('msg.string'),
            'title.required'=>__('msg.required'),
            'summary.required'=>__('msg.required'),
            'image.mimes'=>__('msg.image type'),
            ];
    }
}
