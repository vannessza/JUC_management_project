@extends('projects.layouts.main')

@section('container')
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h1 class="card-title">Profile User</h1>
        </div>
        <div class="card-body">
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
        </div>
    </div>
</div>
@endsection