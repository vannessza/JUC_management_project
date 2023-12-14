@extends('projects.layouts.main')

@section('container')
<div class="form-signin">
    <h1>Edit Project</h1>
    <form method="post" action="{{ route('projects.update', $projects->id) }}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="mb-3">
          <label for="nama_project" class="form-label">Nama Project</label>
          <input type="text" class="form-control" id="nama_project" name="nama_project" value="{{ $projects->nama_project }}" required>
        </div>
        <div class="mb-3">
            <label for="detail_project" class="form-label">Detail Project</label>
            <input type="text" class="form-control" id="detail_project" name="detail_project" value="{{ $projects->detail_project }}" required>
        </div>
        <div class="mb-3">
            <label for="vendor_id" class="form-label" >Vendor</label>
            <select class="form-select" id="vendor_id" name="vendor_id" value="{{ $projects->vendor_id }}" required>
                @foreach($vendor as $ven)
                    <option value="{{ $ven->id }}" {{ $projects->vendor->contains($ven->id) ? 'selected' : '' }}>
                        {{ $ven->nama_perusahaan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="platform" class="form-label">Platform</label>
            <input type="text" class="form-control" id="platform" name="platform" value="{{ $projects->platform }}" required>
        </div>
        <div class="mb-3">
            <label for="disabledSelect" class="form-label">Prioritas</label>
            <select id="disabledSelect" class="form-select" id="prioritas_id" name="prioritas_id" required>
                @foreach($prioritas as $prio)
                    <option value="{{ $prio->id }}" {{ $projects->prioritas_id == $prio->id ? 'selected' : '' }}>
                        {{ $prio->prioritas }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- <div class="mb-3">
            <label for="status_id" class="form-label">Detail</label>
            <input type="text" class="form-control" id="status_id" name="status_id" value="{{ $projects->status_id }}" required>
        </div> --}}
        <div class="mb-3">
            <label for="pic" class="form-label">PIC</label>
            <input type="text" class="form-control" id="pic" name="pic" value="{{ $projects->pic }}" required>
        </div>
        <div class="mb-3">
            <label for="target" class="form-label">Target</label>
            <input type="text" class="form-control" id="target" name="target" value="{{ $projects->target }}" required>
        </div>
        {{-- <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
            <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" required>
        </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection