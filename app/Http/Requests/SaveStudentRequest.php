<?php

namespace App\Http\Requests;

use App\Models\{Course, Student};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\{Rule, Validator};

class SaveStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>|string|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'dob' => ['required', 'date_format:Y-m-d'],
            'address' => ['nullable', 'string'],
            'contact_number' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                Rule::unique(Student::class)->ignore($this->route('student')),
            ],
            'scholarship_accredited' => ['boolean'],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'dob' => 'Date of Birth',
            'address' => 'Address',
            'contact_number' => 'Contact Number',
            'email' => 'Email',
            'scholarship_accredited' => 'Scholarship Accredited',
            'course_id' => 'Course',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'scholarship_accredited' => $this->has('scholarship_accredited'),
        ]);
    }

    protected function email_matches_names()
    {
        return Str::contains($this->email, [str($this->first_name)->lower(), str($this->middle_name)->lower(), str($this->last_name)->lower()]);
    }
}
