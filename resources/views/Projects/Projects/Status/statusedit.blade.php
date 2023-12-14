@extends('projects.projects.showprojects')

@section('status')
<form method="post" action="{{ route('status.update', ['project'=>$status->project_id, 'status'=>$status->id]) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="mb-3">
      <label for="Tanggal" class="form-label">Tanggal</label>
      <input type="text" class="form-control" id="Tanggal" name="Tanggal" value="{{ $status->Tanggal }}" required>
    </div>
    <div class="mb-3">
        <label for="update" class="form-label">Update</label>
        <input type="text" class="form-control" id="update" name="update" value="{{ $status->update }}" required>
    </div>
    {{-- <div class="mb-3">
        <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
        <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" required>
    </div> --}}
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection