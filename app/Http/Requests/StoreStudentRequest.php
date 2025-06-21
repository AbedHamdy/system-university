<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            // 'email' => 'required|email|unique:students,email',
            "password" => "required|min:7|max:255|regex:/[a-z]/|regex:/[0-9]/",
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'code' => 'required|max:10|unique:students,code',
            'national_id' => 'required|digits_between:13,20|unique:students,national_id',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ];
    }
}
