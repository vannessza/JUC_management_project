@extends('projects.layouts.main')

@section('container')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit Profile</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->profile->address }}" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->profile->phone }}" required>
                </div>
                <div class="mb-3">
                    <label for="image">Profile Image:</label>
                    <input type="hidden" name="oldImage" value="{{ $user->profile->image }}">
                    <input type="file" name="image" id="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
