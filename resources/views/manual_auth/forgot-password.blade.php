@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <h1>{{ $title }}</h1>
        <form method="post"
          action="{{ route('password.email') }}"
          novalidate>
          @csrf

          @session('status')
            <div class="alert alert-success alert-dismissible fade show"
              role="alert">
              {{ session('status') }}
              <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
            </div>
          @endsession

          <div class="card">
            <div class="card-body">
              <div class="row gy-4">
                <div class="col-12">
                  <label for="email"
                    class="form-label">Email:</label>
                  <input type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    autofocus />

                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit"
                class="btn btn-primary">Request Reset Password Link</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
