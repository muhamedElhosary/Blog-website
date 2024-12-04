<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MessageRequest extends FormRequest
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
            'name'=>'required|min:10|string',
            'phone'=>'required',
            'message'=>'required|string',
        ];
    }
    public function messages()
    {
        return [
            'name.string'=>__('msg.string'),
            'name.required'=>__('msg.required'),
            'name.min'=>__('msg.min'),
            'phone.required'=>__('msg.required'),
            'message.required'=>__('msg.required'),
            'message.string'=>__('msg.string'),
            ];
    }
    
}
