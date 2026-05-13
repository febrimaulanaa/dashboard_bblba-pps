<!DOCTYPE html>
<html>
<head>
    <title>Data Wisuda</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Data Wisuda</h1>
    <a href="/admin301097">&laquo; Kembali</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>No Meja</th>
                <th>Prodi</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\Wisuda::limit(20)->get() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->nim }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->no_meja_ambil_ijazah }}</td>
                <td>{{ $row->prodi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>