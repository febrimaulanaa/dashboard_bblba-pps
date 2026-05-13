@extends('backend.layout-admin')

@section('content')
<h2 style="margin-bottom: 20px;">Data PKBJJ</h2>

<div class="card">
    <a href="/admin301097" class="btn btn-primary" style="margin-bottom: 15px;">&laquo; Kembali</a>
    
    <table>
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
            @foreach(\App\Models\DataSertifMhs::all() as $row)
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
    <p><strong>Total:</strong> {{ \App\Models\DataSertifMhs::count() }}</p>
</div>
@endsection