@extends('projects.layouts.main')

@section('container')
    <div>
        <h1>{{ $vendors['nama_perusahaan'] }}</h1>
        <p>Alamat: {{ $vendors['alamat'] }}</p>
        <p>Nomor Telepon: {{ $vendors['nomor_telepon'] }}</p>
        <p>Alamat Email: {{ $vendors['alamat_email'] }}</p>
        <p>nama Kontak: {{ $vendors['nama_kontak'] }}</p>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Project</th>
                <th>Detail Project</th>
                <th>Platform</th>
                <th>Prioritas</th>
                <th>Pic</th>
            </tr>
        </thead>
        <tbody>
            @php ($i = 0)
            @foreach($vendors->projects as $pro)
                @php($i++)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $pro['nama_project'] }}</td>
                    <td>{{ $pro['detail_project'] }}</td>
                    <td>{{ $pro['platform'] }}</td>
                    <td>prioritas</td>
                    <td>{{ $pro['pic'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection