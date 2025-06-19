<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            "name" => "required|string|min:3|max:50",
            "email" => "required|email|unique:doctors,email",
            "password" => "required|min:7|max:255|regex:/[a-z]/|regex:/[A-Z]/",
            "image" => "required|image|mimes:jpg,jpeg,png,webp|max:2048",
            "category_id" => "required|exists:categories,id",
        ];
    }
}
