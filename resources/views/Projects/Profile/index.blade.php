@extends('projects.layouts.main')

@section('container')

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h1 class="card-title">Profile</h1>
        </div>
        <div class="card-body">
            @if ($profile)
                <div class="text-center mb-4">
                    @if ($profile->image)
                        <img src="{{ asset('storage/profiles/'. $profile->image) }}" alt="{{ $profile->user->name }}" class="img-thumbnail" width="150">
                    @else
                        <img src="{{ asset('storage/profiles/default.png') }}" alt="Default Image" class="img-thumbnail" width="150">
                    @endif
                </div>
                <p><strong>Name:</strong> {{ $profile->user->name }}</p>
                <p><strong>Email:</strong> {{ $profile->user->email }}</p>
                <p><strong>Username:</strong> {{ $profile->user->username }}</p>
                <p><strong>Address:</strong> {{ $profile->address }}</p>
                <p><strong>Phone:</strong> {{ $profile->phone }}</p>
                <div class="text-center">
                    <a class="btn btn-success" href="{{ route('profile.edit', $profile->id) }}">
                        <i class="fas fa-edit"></i> Update
                    </a>
                    <a class="btn btn-primary" href="{{ route('profile.show-change-password') }}">
                        <i class="fas fa-key"></i> Change Password
                    </a>
                </div>
            @else
                <p>No profile found.</p>
                <div class="text-center">
                    <a class="btn btn-success" href="{{ route('profile.create') }}">
                        <i class="fas fa-arrow-alt-circle-right"></i> Create
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
