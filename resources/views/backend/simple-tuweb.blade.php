<!DOCTYPE html>
<html>
<head>
    <title>Data Tuweb</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    @include('partials.analytics')
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Data Jadwal Tuweb</h1>
    <a href="/admin301097">&laquo; Kembali</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Tutor</th>
                <th>Hari</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\JadwalTuweb::limit(20)->get() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->kode_mk }}</td>
                <td>{{ $row->nama_mk }}</td>
                <td>{{ $row->tutor }}</td>
                <td>{{ $row->hari }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>