<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStudentRequest;
use App\Models\{Course, Student};

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

    public function store(SaveStudentRequest $request)
    {
        Student::create($request->validated());

        return to_route('students.index')->with('success', 'Student has been created.');
    }

    public function edit(Student $student)
    {
        $title = 'Edit Student';

        $genders = ['male', 'female'];

        $courses = Course::all();

        return view('students.edit', compact('title', 'student', 'genders', 'courses'));
    }

    public function update(SaveStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return to_route('students.index')->with('success', 'Student has been edited.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return to_route('students.index')->with('success', 'Student has been deleted.');
    }
}
