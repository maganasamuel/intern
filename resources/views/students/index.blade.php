@extends('layouts.app')

@section('content')
  <div class="container">
    @session('success')
      <div class="alert alert-dismissible fade show alert-success "
        role="alert">
        <div>{{ session('success') }}</div>
        <button type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"></button>
      </div>
    @endsession

    <div class="d-flex align-items-end justify-content-between mb-3">
      <h1 class="mb-0">{{ $title }}</h1>
      <div>
        <a href="{{ route('students.create') }}"
          role="button"
          class="btn btn-primary">Create Student</a>
      </div>
    </div>

    @include('students.filter')

    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Scholarship Accredited</th>
            <th>Course</th>
            <th>Status</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($students as $student)
            <tr>
              <td>{{ $student->full_name }}</td>
              <td class="text-capitalize">{{ $student->gender }}</td>
              <td>{{ $student->dob->format('F j, Y') }}</td>
              <td>{{ $student->address }}</td>
              <td>{{ $student->email }}</td>
              <td>{{ $student->contact_number }}</td>
              <td class="text-center">
                <input type="checkbox"
                  class="form-check-input"
                  readonly
                  @checked($student->scholarship_accredited)
                  onclick="event.preventDefault();"
                  style="height: 1rem; width: 1rem;" />
              </td>
              <td>{{ $student->course->code }} - {{ $student->course->name }}</td>
              <td><span @class(['badge', $student->status->color()])>{{ $student->status->label() }}</span></td>
              <td class="text-nowrap">
                <div class="d-flex align-items-center gap-1">
                  <a href="{{ route('students.show', ['student' => $student->id]) }}"
                    role="button"
                    class="btn btn-sm btn-secondary">View Details</a>
                  <a href="{{ route('students.edit', ['student' => $student->id]) }}"
                    role="button"
                    class="btn btn-sm btn-secondary">Edit</a>
                  <form method="post"
                    action="{{ route('students.destroy', ['student' => $student->id]) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                      class="btn btn-sm btn-danger">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $students->links() }}
    </div>
  </div>
@endsection
