<!DOCTYPE html>
<html>
<head>
    <title>Data Absensi Pegawai</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    @include('partials.analytics')
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Data Absensi Pegawai</h1>
    <a href="/admin301097">&laquo; Kembali</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\AbsensiPegawai::limit(20)->get() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->nama ?? '-' }}</td>
                <td>{{ $row->tanggal }}</td>
                <td>{{ $row->jam_masuk ?? '-' }}</td>
                <td>{{ $row->jam_keluar ?? '-' }}</td>
                <td>{{ $row->status ?? 'Hadir' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total:</strong> {{ \App\Models\AbsensiPegawai::count() }} records</p>
</body>
</html>