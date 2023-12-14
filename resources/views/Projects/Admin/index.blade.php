@extends('projects.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1">Admin</h1>
    <div class="ml-auto">
        <form action="{{ route('projects.search') }}" class="d-flex">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search.." name="search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn text-white bg-dark" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
    </div>
    <div class="text-right">
        <a class="btn btn-success" href="{{ route('admin.create') }}">
            <i class="fas fa-arrow-alt-circle-right"></i> New User
        </a>
    </div>
</div>
@if(count($admin) > 0)
        @php ($i = 0)
        @foreach ($admin as $ad)
        @php($i++)
        <div class="user-entry">
            <div class="position-relative m-4">
                @if ($ad->profile && $ad->profile->image)
                <img src="{{ asset('storage/profiles/' . $ad->profile->image) }}" class="img-fluid rounded-circle" alt="{{ $ad->username }}" width="100" height="100">
                @else
                    <img src="{{ asset('storage/profiles/default.png') }}" class="img-fluid rounded-circle" alt="" width="50" height="50">
                @endif
                <a class="no-underline" href=""><strong>{{ $ad->username }}</strong> ( {{ $ad->email }})</a>
                <div class="btn-group float-end" role="group" aria-label="Basic mixed styles example">
                    <a class="btn btn-primary" href="{{ route('admin.edit', $ad->id) }}">
                        <i class="fas fa-arrow-alt-circle-right"></i>Edit
                    </a>
                    <a class="btn btn-danger" href="{{ route('admin.delete', $ad->id) }}">
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
