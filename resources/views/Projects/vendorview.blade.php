@extends('projects.layouts.main')

@section('container')
<h1 class="text-center">All Vendor</h1>
<br>
<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="{{ route('vendor.search') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search.." name="search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn text-white bg-dark" type="submit" id="search">Search</button>
            </div>
        </form>
    </div>
</div>
<br>
<div class="row">
    @foreach ($vendor as $ven)
    <div class="col-md-4 mb-3">
        <div class="card p-3" style="max-width: 540px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #f8f9fa;">
            <div class="row g-0">
                <div class="col-md-4">
                    @if ($ven->image)
                        <img src="{{ asset('storage/vendor/' . $ven->image) }}" class="img-fluid rounded-circle" alt="">
                    @else
                        <img src="{{ asset('storage/profiles/defaultcompany.png') }}" class="img-fluid rounded-circle" alt="">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $ven['nama_perusahaan'] }}</h5>
                        <p class="card-text">Alamat: {{ $ven['alamat'] }}</p>
                        <p class="card-text">No Telp: {{ $ven['nomor_telepon'] }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('vendor.show', $ven->id) }}" class="btn btn-primary btn-sm float-end">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
