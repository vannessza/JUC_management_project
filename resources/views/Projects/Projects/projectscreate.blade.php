@extends('projects.layouts.main')

@section('container')
<div class="form-signin">
    <h1>Create Project</h1>
    <form method="post" action="{{ route('projects.store') }}">
        @csrf
        <div class="mb-3">
          <label for="nama_project" class="form-label">Nama Project</label>
          <input type="text" class="form-control" id="nama_project" name="nama_project" required>
        </div>
        <div class="mb-3">
            <label for="detail_project" class="form-label">Detail Project</label>
            <input type="text" class="form-control" id="detail_project" name="detail_project" required>
        </div>
        <div class="mb-3">
            <label for="vendor_id" class="form-label" >Vendor</label>
            <select class="form-select" id="vendor_id" name="vendor_id" required>
                @foreach ($vendor as $ven)
                    <option value="{{ $ven->id }}">{{ $ven->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="platform" class="form-label">Platform</label>
            <input type="text" class="form-control" id="platform" name="platform" required>
        </div>
        <div class="mb-3">
            <label for="disabledSelect" class="form-label">Prioritas</label>
            <select id="disabledSelect" class="form-select" id="prioritas_id" name="prioritas_id" required>
                @foreach ($prioritas as $pr)
                    <option value="{{ $pr->id }}">{{ $pr->prioritas }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <input type="text" class="form-control" id="status_id" name="status_id" required>
        </div> --}}
        <div class="mb-3">
            <label for="pic" class="form-label">PIC</label>
            <input type="text" class="form-control" id="pic" name="pic" required>
        </div>
        <div class="mb-3">
            <label for="target" class="form-label">Target</label>
            <input type="text" class="form-control" id="target" name="target" required>
        </div>
        <div class="mb-3">
            <label for="disabledSelect" class="form-label">Progress</label>
            <select id="disabledSelect" class="form-select" id="status_progress_id" name="status_progress_id" required>
                @foreach ($progress as $pro)
                    <option value="{{ $pro->id }}">{{ $pro->status_progress }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
            <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" required>
        </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection