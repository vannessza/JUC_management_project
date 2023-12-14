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
  <link rel="stylesheet" href="/css/export.css">
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
    <br>
    <div class="card">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" colspan="2" class="judul"><h2>Nama Project </h2></th>
                <th class="width_small"><h2>:</h2></th>
                <th scope="col" colspan="3" class="text"><h2>{{ $projects['nama_project'] }}</h2></th>
            </tr>
            <tr>
                <th scope="col" colspan="2" class="judul"><h2>Detail Proyek</h2></th>
                <th><h2>:</h2></th>
                <th scope="col" colspan="3" class="text"><h2>{{ $projects['detail_project'] }}</h2></th>
            </tr>
            <tr>
                <th scope="col" colspan="2" class="judul"><h2>Platform</h2></th>
                <th class=""><h2>:</h2></th>
                <th scope="col" colspan="3" class="text"><h2>{{ $projects['platform'] }}</h2></th>
            </tr>
            <tr>
                <th scope="col" colspan="2" class="judul"><h2>Vendor</h2></th>
                <th><h2>:</h2></th>
                <th scope="col" colspan="3" class="text">
                    @foreach ($projects->vendor as $vendor)
                       <h2>{{ $vendor->nama_perusahaan }}</h2>
                    @endforeach
                </th>
            </tr>
            <tr>
                <th scope="col" colspan="2" class="judul"><h2>PIC Vendor</h2></th>
                <th><h2>:</h2></th>
                <th scope="col" colspan="3" class="text">
                    @foreach ($projects->vendor as $vendor)
                        <h2>{{ $vendor->nama_kontak }}</h2>
                    @endforeach
                </th>
            </tr>
            <tr>
                <th scope="col" colspan="2" class="judul"><h2>Platform</h2></th>
                <th><h2>:</h2></th>
                <th scope="col" colspan="3" class="text"><h2>{{ $projects['platform'] }}</h2></th>
            </tr>
            <tr>
                <th scope="col" colspan="2" class="judul"><h2>Proprity</h2></th>
                <th><h2>:</h2></th>
                <th scope="col" colspan="3" class="text"><h2>{{ $projects->prioritas->prioritas}}</h2></th>
            </tr>
            <tr>
                <th colspan="6"><h2>Status</h2></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tgl title">Tanggal</td>
                <td colspan="4" class="title update">Update</td>
                <td class="title comment">comment</td>
            </tr>
            @php ($i = 0)
            @foreach ($projects->status as $sta)
            @php($i++)
            <tr>
                <td class="content">{{ $sta->Tanggal }}</td>
                <td class="width_big content" colspan="4">{{ $sta->update }}</td>
                <td class="content">{{ $sta->comment }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table>
        
    </table>
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