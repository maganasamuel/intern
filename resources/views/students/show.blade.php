@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Student Details</h1>
    <div class="card">
      <div class="card-body">
        <dl class="row">
          <dt class="col-lg-3">First Name</dt>
          <dd class="col-lg-9">{{ $student->first_name }}</dd>
        </dl>
        <dl class="row">
          <dt class="col-lg-3">Middle Name</dt>
          <dd class="col-lg-9">{{ $student->middle_name }}</dd>
        </dl>
        <dl class="row">
          <dt class="col-lg-3">Last Name</dt>
          <dd class="col-lg-9">{{ $student->last_name }}</dd>
        </dl>
        <dl class="row">
          <dt class="col-lg-3">Gender</dt>
          <dd class="col-lg-9">{{ $student->gender }}</dd>
        </dl>
        <dl class="row">
          <dt class="col-lg-3">Date of Birth</dt>
          <dd class="col-lg-9">{{ $student->dob->format('F j, Y') }}</dd>
        </dl>
        <dl class="row">
          <dt class="col-lg-3">Address</dt>
          <dd class="col-lg-9">{{ $student->address }}</dd>
        </dl>
        <dl class="row">
          <dt class="col-lg-3">Contact Number</dt>
          <dd class="col-lg-9">{{ $student->contact_number }}</dd>
        </dl>
        <dl class="row">
          <dt class="col-lg-3">Scholarship Accredited</dt>
          <dd class="col-lg-9">
            <span @class([
                'badge',
                'text-bg-success' => $student->scholarship_accredited,
                'text-bg-danger' => !$student->scholarship_accredited,
            ])>{{ $student->scholarship_accredited ? 'YES' : 'NO' }}</span>
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-lg-3">Course</dt>
          <dd class="col-lg-9">{{ $student->course->code . ' - ' . $student->course->name }}</dd>
        </dl>
      </div>
    </div>
  </div>
@endsection
