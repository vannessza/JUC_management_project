@extends('projects.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1">User</h1>
    <div class="ml-auto">
        <form action="{{ route('projects.search') }}" class="d-flex">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search.." name="search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn text-white bg-dark" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
    </div>
    <div class="text-right">
        <a class="btn btn-success" href="{{ route('user.create') }}">
            <i class="fas fa-arrow-alt-circle-right"></i> New User
        </a>
    </div>
</div>
@if(count($users) > 0)
        @php ($i = 0)
        @foreach ($users as $us)
        @php($i++)
        <div class="user-entry">
            <div class="position-relative m-4">
                @if ($us->profile && $us->profile->image)
                <img src="{{ asset('storage/profiles/' . $us->profile->image) }}" class="img-fluid rounded-circle" alt="{{ $us->username }}" width="100" height="100">
                @else
                    <img src="{{ asset('storage/profiles/default.png') }}" class="img-fluid rounded-circle" alt="" width="50" height="50">
                @endif
                <a class="no-underline" href=""><strong>{{ $us->username }}</strong> ( {{ $us->email }})</a>
                <div class="btn-group float-end" role="group" aria-label="Basic mixed styles example">
                    <a class="btn btn-primary" href="{{ route('user.edit', $us->id) }}">
                        <i class="fas fa-arrow-alt-circle-right"></i>Edit
                    </a>
                    <a class="btn btn-danger" href="{{ route('user.delete', $us->id) }}">
                        <i class="fas fa-arrow-alt-circle-right"></i> Delete
                    </a>
                </div>
            </div>
        </div>
        @endforeach
@else
<div class="alert alert-info">
    Belum ada data yang tersedia.
</div>
@endif

@endsection
