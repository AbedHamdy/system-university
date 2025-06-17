<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSemesterRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'academic_year' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
            'semesters' => 'required|array|size:3',
            'semesters.*.semester_number' => 'required|integer|between:1,3',
            'semesters.*.start_date' => 'required|date',
            'semesters.*.end_date' => 'required|date|after_or_equal:semesters.*.start_date',
        ];
    }
}
