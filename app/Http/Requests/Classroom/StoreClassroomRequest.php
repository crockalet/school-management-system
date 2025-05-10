<?php

namespace App\Http\Requests\Classroom;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'max_students' => 'required|integer|min:1',
            'students' => 'sometimes|array',
            'students.*.id' => 'exists:students,id',
        ];
    }
}
