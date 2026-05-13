@extends('backend.layout-admin')

@section('content')
<div class="page-title">Data Wisuda</div>

<div class="card">
    <div style="margin-bottom: 15px;">
        <a href="/admin301097" class="btn btn-primary">&laquo; Kembali ke Dashboard</a>
    </div>
    
    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>No Meja</th>
                <th>No Urut Ijazah</th>
                <th>Prodi</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\Wisuda::all() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->nim }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->no_meja_ambil_ijazah }}</td>
                <td>{{ $row->no_urut_ijazah }}</td>
                <td>{{ $row->prodi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total:</strong> {{ \App\Models\Wisuda::count() }} data</p>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>
@endsection