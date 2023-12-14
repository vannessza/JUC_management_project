@extends('projects.projects.showprojects')

@section('status')
     <div class="card">
        <div class="card-header">
            <h4 class="card-title">Status History</h4>
        </div>
        <div class="card-body">
            @foreach ($projects->status as $sta)
            @if ($sta)
                <p><strong>Tanggal:</strong> {{ $sta->Tanggal }}</p>
                <p><strong>Update:</strong> {{ $sta->update }}</p>
                <p><strong>Comment:</strong> {{ $sta->comment }}</p>
                <br>
            @else
                <p>No updates available for this project.</p>
            @endif
            @endforeach
        </div>
    </div>
@endsection