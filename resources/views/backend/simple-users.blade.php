<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Pegawai</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Manajemen Pegawai</h1>
    <a href="/admin301097">&laquo; Kembali</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\User::limit(20)->get() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->role ?? 'pegawai' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>