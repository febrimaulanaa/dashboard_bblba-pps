<!DOCTYPE html>
<html>
<head>
    <title>Data Seminar</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Data Seminar Akademik</h1>
    <a href="/admin301097">&laquo; Kembali</a>
    <table class="table table-bordered mt-3">
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
            @foreach(\App\Models\DataSertifSeminar::limit(20)->get() as $row)
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
    <p><strong>Total:</strong> {{ \App\Models\DataSertifSeminar::count() }} data</p>
</body>
</html>