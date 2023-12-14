@extends('projects.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1">My Vendor</h1>
    <div class="ml-auto">
        {{-- <form action="{{ route('vendor.search') }}" class="d-flex">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search.." name="search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn text-white bg-dark" type="submit" id="button-addon2">Search</button>
            </div>
        </form> --}}
    </div>
    <div class="text-right">
        {{-- <a class="btn btn-warning" href="{{ route('vendor.export') }}">
            <i class="fas fa-arrow-alt-circle-right"></i> Export
        </a> --}}
        <a class="btn btn-success" href="{{ route('vendor.create') }}">
            <i class="fas fa-arrow-alt-circle-right"></i> Create
        </a>
    </div>
</div>

@if(count($vendor) > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive small">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Perusahaan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Alamat Email</th>
                        <th scope="col">Nama Kontak</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i = 0)
                    @foreach ($vendor as $ven)
                    @php($i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $ven['nama_perusahaan'] }}</td>
                        <td>{{ $ven['alamat'] }}</td>
                        <td>{{ $ven['nomor_telepon'] }}</td>
                        <td>{{ $ven['alamat_email'] }}</td>
                        <td>{{ $ven['nama_kontak'] }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a class="btn btn-info" href="{{ route('vendor.show', $ven->id) }}">
                                    <i class="fas fa-arrow-alt-circle-right"></i>Detail
                                </a>
                                <a class="btn btn-primary" href="{{ route('vendor.edit', $ven->id) }}">
                                    <i class="fas fa-arrow-alt-circle-right"></i>Edit
                                </a>
                                <a class="btn btn-danger" href="{{ route('vendor.delete', $ven->id) }}">
                                    <i class="fas fa-arrow-alt-circle-right"></i>Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert alert-info">
    Belum ada data yang tersedia.
</div>
@endif

@endsection
