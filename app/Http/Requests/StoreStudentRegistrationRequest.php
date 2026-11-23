<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'school_target' => ['required', 'string', Rule::in(['SD', 'SMP', 'SMA'])],
            'school_year' => ['required', 'string', Rule::in(['2026/2027', '2027/2028'])],
            'student_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
            'parent_guardian_name' => ['required', 'string', 'max:255'],
            'parent_guardian_phone' => ['required', 'string', 'max:30'],
            'home_address' => ['required', 'string', 'max:2000'],
        ];
    }
}
