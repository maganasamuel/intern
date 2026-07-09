@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="mb-3">{{ $title }}</h1>
    <div class="row">
      <div class="col-lg-6">
        <form action="{{ route('students.store') }}"
          method="post"
          novalidate>
          @csrf()
          <div class="card">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-12">
                  <label for="first_name"
                    class="form-label">First Name:</label>
                  <input type="text"
                    id="first_name"
                    name="first_name"
                    class="form-control @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name') }}"
                    autofocus />

                  @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="middle_name"
                    class="form-label">Middle Name:</label>
                  <input type="text"
                    id="middle_name"
                    name="middle_name"
                    class="form-control @error('middle_name') is-invalid @enderror"
                    value="{{ old('middle_name') }}" />

                  @error('middle_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="last_name"
                    class="form-label">Last Name:</label>
                  <input type="text"
                    id="last_name"
                    name="last_name"
                    class="form-control @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name') }}" />

                  @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="gender"
                    class="form-label">Gender:</label>
                  <select id="gender"
                    name="gender"
                    class="form-control @error('gender') is-invalid @enderror form-select text-capitalize">
                    <option value=""
                      @selected(!old('gender'))>- Select an option... -</option>

                    @foreach ($genders as $gender)
                      <option value="{{ $gender }}"
                        @selected(old('gender') == $gender)>{{ $gender }}</option>
                    @endforeach
                  </select>

                  @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="dob"
                    class="form-label">Date of Birth:</label>
                  <input type="date"
                    id="dob"
                    name="dob"
                    class="form-control @error('dob') is-invalid @enderror"
                    value="{{ old('dob') }}" />

                  @error('dob')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="address"
                    class="form-label">Address:</label>
                  <textarea id="address"
                    name="address"
                    class="form-control @error('address') is-invalid @enderror"
                    rows="4">{{ old('address') }}</textarea>

                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="contact_number"
                    class="form-label">Contact Number:</label>
                  <input type="text"
                    id="contact_number"
                    name="contact_number"
                    class="form-control @error('contact_number') is-invalid @enderror"
                    value="{{ old('contact_number') }}" />

                  @error('contact_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="email"
                    class="form-label">Email:</label>
                  <input type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" />

                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input type="checkbox"
                      id="scholarship_accredited"
                      name="scholarship_accredited"
                      class="form-check-input @error('scholarship_accredited') is-invalid @enderror"
                      value="1"
                      @checked(old('scholarship_accredited'))>
                    <label class="form-check-label"
                      for="scholarship_accredited">
                      Scholarship Accredited
                    </label>

                    @error('scholarship_accredited')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <label for="gender"
                    class="form-label">Course:</label>
                  <select id="course_id"
                    name="course_id"
                    class="form-control @error('course_id') is-invalid @enderror form-select">
                    <option value=""
                      @selected(!old('course_id'))>- Select an option... -</option>

                    @foreach ($courses as $course)
                      <option value="{{ $course->id }}"
                        @selected(old('course_id') == $course->id)>{{ $course->code . ' - ' . $course->name }}</option>
                    @endforeach
                  </select>

                  @error('course_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="d-flex align-items-center gap-3">
                <button type="submit"
                  class="btn btn-primary">Create</button>
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
