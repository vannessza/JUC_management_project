@extends('projects.projects.showprojects')

@section('container')
<div>
    <h1>Create Status</h1>
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
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection