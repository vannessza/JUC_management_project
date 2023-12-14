@extends('projects.layouts.main')

@section('container')
<div class="form-signin">
    <h1>Create Vendor</h1>
    <form method="post" action="{{ route('vendor.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="nama_perusahaan" class="form-label">Nama perusahaan</label>
          <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
        </div>
        <div class="mb-3">
            <label for="alamat_email" class="form-label">Alamat Email</label>
            <input type="text" class="form-control" id="alamat_email" name="alamat_email" required>
        </div>
        <div class="mb-3">
            <label for="nama_kontak" class="form-label">Nama Kontak</label>
            <input type="text" class="form-control" id="nama_kontak" name="nama_kontak" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Logo Perusahaan</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
        </div>
        
        {{-- <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
            <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" required>
        </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection