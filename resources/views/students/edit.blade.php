@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="mb-3">{{ $title }}</h1>
    <div class="row">
      <div class="col-lg-6">
        <form action="{{ route('students.update', ['student' => $student->id]) }}"
          method="post">
          @csrf()
          @method('PUT')

          <div class="card">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-12">
                  <label for="first_name"
                    class="form-label">First Name:</label>
                  <input type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ old('first_name', $student->first_name) }}"
                    class="form-control"
                    autofocus />
                </div>
                <div class="col-12">
                  <label for="middle_name"
                    class="form-label">Middle Name:</label>
                  <input type="text"
                    id="middle_name"
                    name="middle_name"
                    value="{{ old('middle_name', $student->middle_name) }}"
                    class="form-control" />
                </div>
                <div class="col-12">
                  <label for="last_name"
                    class="form-label">Last Name:</label>
                  <input type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ old('last_name', $student->last_name) }}"
                    class="form-control" />
                </div>
                <div class="col-12">
                  <label for="gender"
                    class="form-label">Gender:</label>
                  <select id="gender"
                    name="gender"
                    class="form-control form-select text-capitalize">
                    <option value=""
                      @selected(!old('gender', $student->gender))>- Select an option... -</option>

                    @foreach ($genders as $gender)
                      <option value="{{ $gender }}"
                        @selected(old('gender', $student->gender) == $gender)>{{ $gender }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-12">
                  <label for="dob"
                    class="form-label">Date of Birth:</label>
                  <input type="date"
                    id="dob"
                    name="dob"
                    value="{{ old('dob', $student->dob->format('Y-m-d')) }}"
                    class="form-control" />
                </div>
                <div class="col-12">
                  <label for="address"
                    class="form-label">Address:</label>
                  <textarea id="address"
                    name="address"
                    class="form-control"
                    rows="4">{{ old('address', $student->address) }}</textarea>
                </div>
                <div class="col-12">
                  <label for="contact_number"
                    class="form-label">Contact Number:</label>
                  <input type="text"
                    id="contact_number"
                    name="contact_number"
                    value="{{ old('contact_number', $student->contact_number) }}"
                    class="form-control" />
                </div>
                <div class="col-12">
                  <label for="email"
                    class="form-label">Email:</label>
                  <input type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $student->email) }}" />

                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input type="checkbox"
                      id="scholarship_accredited"
                      name="scholarship_accredited"
                      value="1"
                      class="form-check-input"
                      @checked(old('scholarship_accredited', $student->scholarship_accredited))>
                    <label class="form-check-label"
                      for="scholarship_accredited">
                      Scholarship Accredited
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <label for="gender"
                    class="form-label">Course:</label>
                  <select id="course_id"
                    name="course_id"
                    class="form-control form-select text-capitalize">
                    <option value=""
                      @selected(!old('course_id', $student->course_id))>- Select an option... -</option>

                    @foreach ($courses as $course)
                      <option value="{{ $course->id }}"
                        @selected(old('course_id', $student->course_id) == $course->id)>{{ $course->code . ' - ' . $course->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="d-flex align-items-center gap-3">
                <button type="submit"
                  class="btn btn-primary">Edit</button>
                <a href="{{ route('students.index') }}"
                  role="button"
                  class="btn btn-secondary">Cancel</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
