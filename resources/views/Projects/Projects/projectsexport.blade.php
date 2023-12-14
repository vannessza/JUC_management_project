<?php
//import koneksi ke database
?>
<html>
<head>
  <title>Project</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <style>
                th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>My Project</h2>
    <div class="data-tables datatable-dark">
        <table class="table table-striped table-sm" id="mauexport">
            <thead>
                <tr>
                    <th scope="col" rowspan="2">No</th>
                    <th scope="col" rowspan="2">Nama Project</th>
                    <th scope="col" rowspan="2">Detail Project</th>
                    <th scope="col" rowspan="2">Vendor</th>
                    <th scope="col" rowspan="2">Platform</th>
                    <th scope="col" rowspan="2">Prioritas</th>
                    <th scope="col" colspan="2">Status</th>
                    <th scope="col" rowspan="2">PIC</th>
                    <th scope="col" rowspan="2">Target</th>
                </tr>
                <tr> 
                    <th scope="col">Tanggal</th>
                    <th scope="col">Update</th>
                  </tr>
            </thead>
            <tbody>
                @php ($i = 0)
                @foreach ($projects as $pro)
                    @php($i++)
                    <tr>
                        <td class="p-2">{{ $i }}</td>
                        <td class="p-2">{{ $pro['nama_project'] }}</td>
                        <td class="p-2">{{ $pro['detail_project'] }}</td>
                        <td class="p-2">{{ implode(', ', $pro->vendor->pluck('nama_perusahaan')->toArray()) }}</td>
                        <td class="p-2">{{ $pro['platform'] }}</td>
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
                            @if ($pro->status->isNotEmpty())
                                <p>{{ $pro->status->first()->Tanggal }}</p>
                            @else
                                <p>No updates available.</p>
                            @endif
                        </td>
                        <td>
                            @if ($pro->status->isNotEmpty())
                                <p>{{ $pro->status->first()->update }}</p>
                            @else
                                <p>No updates available.</p>
                            @endif
                        </td>
                        <td class="p-2">{{ $pro['pic'] }}</td>
                        <td class="p-2">{{ $pro['target'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>
</html>
