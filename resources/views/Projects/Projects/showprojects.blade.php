@extends('projects.layouts.main')

@section('container')
<br>
<a class="btn btn-warning" href="{{ route('projects_show.export', $projects->id) }}">
    <i class="fas fa-arrow-alt-circle-right"></i> Export
</a>

<br>
<br>
<div class="card mb-3">
    <div class="card-header bg-dark text-white">
        <h1 class="card-title">{{ $projects['nama_project'] }}</h1>
    </div>
    <div class="card-body">
        <p class="card-text">Detail Project: {{ $projects['detail_project'] }}</p>
        <p class="card-text">Platform: {{ $projects['platform'] }}</p>
        <p class="card-text">Prioritas: {{ $projects->prioritas->prioritas}}</p>
        <p class="card-text">PIC: {{ $projects['pic'] }}</p>
        <p class="card-text">Target: {{ $projects['target'] }}</p>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="card-title">Vendor</h3>
            </div>
            <div class="card-body">
                <div class="add-person-form" id="team-members">
                    @foreach ($projects->vendor as $vendor)
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center" style="width: 65px; height: 65px;">
                                @if ($vendor->image)
                                <img src="{{ asset('storage/profiles/' . $vendor->image) }}" class="img-fluid rounded-circle" alt="">
                                @else
                                <img src="{{ asset('storage/profiles/defaultcompany.png') }}" class="img-fluid rounded-circle" alt="">
                                @endif
                                <h5 class="card-title ml-3 m-2">{{ $vendor->nama_perusahaan}}</h5>
                                @if (Auth::id() === $projects->id_owner)
                                <form method="POST" action="{{ route('projects.add_vendor_delete', ['projects' => $projects->id, 'vendor' => $vendor->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove Vendor</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <br>
                    @if (Auth::id() === $projects->id_owner)
                    <a class="btn btn-primary" href="{{ route('projects.add_vendor', ['projects' => $projects->id]) }}">Add Vendor</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="card-title">Team</h3>
            </div>
            <div class="card-body">
                <div class="add-person-form" id="team-members">
                    @foreach ($projects->users as $user)
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center" style="width: 65px; height: 65px;">
                                @if ($user->profile->image)
                                <img src="{{ asset('storage/profiles/' . $user->profile->image) }}" class="img-fluid rounded-circle" alt="{{ $user->username }}">
                                @else
                                <img src="{{ asset('storage/profiles/default.png') }}" class="img-fluid rounded-circle" alt="">
                                @endif
                                <h5 class="card-title ml-3 m-2">
                                    <a href="{{ route('projects.add_user_show', ['user' => $user->id]) }}" style="text-decoration: none; color: inherit;">
                                        {{ $user->username }}
                                    </a>
                                </h5>
                                @if (!$loop->first)
                                @if (Auth::id() === $projects->id_owner)
                                <form method="POST" action="{{ route('projects.add_user_delete', ['projects' => $projects->id, 'user' => $user->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove User</button>
                                </form>
                                @endif
                                @endif
                                @if (Auth::id() === $user->id)
                                <form method="POST" action="{{ route('projects.add_user_leave', ['projects' => $projects->id, 'user' => $user->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Leave</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <br>
                    @if (Auth::id() === $projects->id_owner)
                    <a class="btn btn-primary" href="{{ route('projects.add_user', ['projects' => $projects->id]) }}">Add Person</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div>
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title">Status:</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('status.store') }}">
                @csrf
                <input type="hidden" name="project_id" value="{{ $projects->id }}">
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="mb-3">
                    <label for="update" class="form-label">Update</label>
                    <input type="text" class="form-control" id="update" name="update" required>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <input type="text" class="form-control" id="comment" name="comment" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/projects/store/status/*') ? 'active' : '' }}" href="{{ route('status.index', $projects->id) }}">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/projects/store/history/*') ? 'active' : '' }}" href="{{ route('status.history', $projects->id) }}">History</a>
        </li>
        <li>
        </li>
    </ul>
    @yield('status')
</div>
@endsection
