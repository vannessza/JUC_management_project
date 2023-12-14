@extends('projects.layouts.main')

@section('container')
<div class="form-signin">
<h1>Add User</h1>
<form action="{{ route('user.store') }}" method="post">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" name="name" class="form-control rounded-top mb-3 @error('name')is-invalid @enderror" id="name" required value="{{ old('name') }}">
      @error('name')
          <div class="invalid-feedback">
            Please choose a username.
          </div>
        @enderror
    </div>
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" class="form-control rounded-top mb-3" id="username" required value="{{ old('username') }}">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" name="email" class="form-control rounded-top mb-3" id="email" required value="{{ old('email') }}">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control rounded-top mb-3" id="password" required value="{{ old('password') }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


@endsection