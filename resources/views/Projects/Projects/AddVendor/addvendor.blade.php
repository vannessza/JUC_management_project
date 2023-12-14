@extends('projects.layouts.main')

@section('container')
<div class="form-signin">
    <h1>Add Vendor to Project:</h1>
    <form method="POST" action="{{ route('projects.add_vendor_store', ['projects' => $projects->id]) }}">
      @csrf
      <div class="mb-3">
        <label for="disabledSelect" class="form-label">List User</label>
        <select id="vendor_id" class="form-select" name="vendor_id" required>
            @foreach ($availablevendor as $vendor)
                <option value="{{ $vendor->id }}">{{ $vendor->nama_perusahaan }}</option>
            @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-success">Add Vendor</button>
    </form>
</div>
@endsection