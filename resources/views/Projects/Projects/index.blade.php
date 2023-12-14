@extends('projects.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1">My Projects</h1>
    <div class="ml-auto">
        <form action="{{ route('projects.search') }}" class="d-flex">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search.." name="search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn text-white bg-dark" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
    </div>
    <div class="text-right">
        <a class="btn btn-warning" href="{{ route('projects.export') }}">
            <i class="fas fa-arrow-alt-circle-right"></i> Export
        </a>
        <a class="btn btn-success" href="{{ route('projects.create') }}">
            <i class="fas fa-arrow-alt-circle-right"></i> Create
        </a>
    </div>
</div>



@if(count($projects) > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive small">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Project</th>
                        <th scope="col">Detail Project</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Platform</th>
                        <th scope="col">Prioritas</th>
                        <th scope="col">Progress</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i = 0)
                    @foreach ($projects as $pro)
                    @php($i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $pro['nama_project'] }}</td>
                        <td>{{ $pro['detail_project'] }}</td>
                        <td class="p-2">{{ implode(', ', $pro->vendor->pluck('nama_perusahaan')->toArray()) }}</td>
                        <td>
                            {{ $pro['platform'] }}
                        </td>
                        <td>
                            <p class="
                              @if ($pro->prioritas->prioritas === 'High')
                                  text-center bg-danger p-2 text-dark
                              @elseif($pro->prioritas->prioritas === 'Medium')
                                  text-center bg-warning p-2 text-dark
                              @elseif($pro->prioritas->prioritas === 'Low')
                                  text-center bg-success p-2 text-dark bg-opacity-25
                              @elseif($pro->prioritas->prioritas === 'Pending')
                                  text-center bg-success p-2 text-dark bg-opacity-25
                              @endif
                            ">{{ $pro->prioritas->prioritas }}</p>
                        </td>
                        <td>
                            <p class="
                              @if ($pro->progress->status_progress === 'New')
                                  text-center bg-info p-2 text-dark
                              @elseif($pro->progress->status_progress === 'Progress')
                                  text-center bg-warning p-2 text-dark
                              @elseif($pro->progress->status_progress === 'Completed')
                                  text-center bg-success p-2 text-dark bg-opacity-25
                              @endif
                            ">{{ $pro->progress->status_progress }}</p>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a class="btn btn-info" href="{{ route('projects.show', $pro->id) }}">
                                    <i class="fas fa-arrow-alt-circle-right"></i>Show
                                </a>
                                @if (Auth::id() === $pro->id_owner || Auth::user()->hasRole('admin') || Auth::user()->hasRole('adminsuper'))
                                <a class="btn btn-primary" href="{{ route('projects.edit', $pro->id) }}">
                                    <i class="fas fa-arrow-alt-circle-right"></i>Edit
                                </a>
                                <a class="btn btn-danger" href="{{ route('projects.delete', $pro->id) }}">
                                    <i class="fas fa-arrow-alt-circle-right"></i>Delete
                                </a>
                                @endif
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
