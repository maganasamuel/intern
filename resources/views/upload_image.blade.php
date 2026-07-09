@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <h1>{{ $title }}</h1>

        @session('success')
          <div class="alert alert-success">{{ session('success') }}</div>
        @endsession

        <form action="{{ route('image.upload') }}"
          method="post"
          enctype="multipart/form-data">
          @csrf

          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <label for="image"
                    class="form-label">Please choose an image</label>
                  <input type="file"
                    id="image"
                    name="image"
                    class="form-control @error('image') is-invalid @enderror" />

                  @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit"
                class="btn btn-primary">Upload</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
