@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <h1>{{ $title }}</h1>

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

        <form action="{{ route('login') }}"
          method="post"
          novalidate>
          @csrf

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
                <div class="col-12">
                  <label for="password"
                    class="form-label">Password:</label>
                  <input type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror" />

                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror()
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input @error('remember') is-invalid @enderror"
                      type="checkbox"
                      id="remember"
                      name="remember"
                      value="1"
                      @checked(old('remember'))>
                    <label class="form-check-label"
                      for="remember">
                      Remember me
                    </label>

                    @error('remember')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="d-flex align-items-center justify-content-between">
                <button type="submit"
                  class="btn btn-primary">Login</button>
                <a href="{{ route('password.request') }}">Forgot Password</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
