@extends('projects.projects.showprojects')

@section('status')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Latest Status Update</h4>
        </div>
        <div class="card-body">
            @if ($latestStatus)
                <p><strong>Tanggal:</strong> {{ $latestStatus->Tanggal }}</p>
                <p><strong>Update:</strong> {{ $latestStatus->update }}</p>
                <p><strong>Comment:</strong> {{ $latestStatus->comment }}</p>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a class="btn btn-primary" href="{{ route('status.edit', ['project'=>$latestStatus->project_id, 'status'=>$latestStatus->id]) }}">
                        <i class="fas fa-arrow-alt-circle-right"></i>Edit</a>
                    {{-- <a class="btn btn-danger" href="{{ route('status.delete', ['project'=>$latestStatus->project_id, 'status'=>$latestStatus->id]) }}">
                        <i class="fas fa-arrow-alt-circle-right"></i>Delete</a> --}}
                </div>
            @else
                <p>No updates available for this project.</p>
            @endif
        </div>
    </div>
@endsection
