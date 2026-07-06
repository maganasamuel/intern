<?php

namespace App\Http\Controllers;

use App\Models\{Course, Student};
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('course')
            ->latest()
            ->paginate();

        $title = 'Students';

        return view('students.index', compact('title', 'students'));
    }

    public function show(Student $student)
    {
        $title = 'Student Details';

        $student->load(['course']);

        return view('students.show', compact('title', 'student'));
    }

    public function create()
    {
        $title = 'Create Student';

        $genders = ['male', 'female', 'others'];

        $courses = Course::all();

        return view('students.create', compact('title', 'genders', 'courses'));
    }

    public function store()
    {
        $data = request()->validate([
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
                Rule::unique(Student::class),
            ],
            'scholarship_accredited' => ['boolean'],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
        ], [], [
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'dob' => 'Date of Birth',
            'address' => 'Address',
            'contact_number' => 'Contact Number',
            'scholarship_accredited' => 'Scholarship Accredited',
            'course_id' => 'Course',
        ]);

        Student::create($data);

        return to_route('students.index')->with('success', 'Student has been created.');
    }

    public function edit(Student $student)
    {
        $title = 'Edit Student';

        $genders = ['male', 'female'];

        $courses = Course::all();

        return view('students.edit', compact('title', 'student', 'genders', 'courses'));
    }

    public function update(Student $student)
    {
        $data = request()->merge([
            'scholarship_accredited' => request()->has('scholarship_accredited'),
        ])->validate([
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
                Rule::unique(Student::class)
                    ->ignore($student),
            ],
            'scholarship_accredited' => ['required', 'boolean'],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
        ], [], [
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'dob' => 'Date of Birth',
            'address' => 'Address',
            'contact_number' => 'Contact Number',
            'scholarship_accredited' => 'Scholarship Accredited',
            'course_id' => 'Course',
        ]);

        $student->update($data);

        return to_route('students.index')->with('success', 'Student has been edited.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return to_route('students.index')->with('success', 'Student has been deleted.');
    }
}
