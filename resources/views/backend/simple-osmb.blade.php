@extends('backend.layout-admin')

@section('content')
<div class="page-title">Data OSMB</div>

<div class="card">
    <div style="margin-bottom: 15px;">
        <a href="/admin301097" class="btn btn-primary">&laquo; Kembali ke Dashboard</a>
    </div>
    
    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Masa</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\DataSertifOSMB::all() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->masa }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->nim }}</td>
                <td>{{ $row->prodi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total:</strong> {{ \App\Models\DataSertifOSMB::count() }} data</p>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>
@endsection