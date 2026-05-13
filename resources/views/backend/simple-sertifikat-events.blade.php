<!DOCTYPE html>
<html>
<head>
    <title>Events Sertifikat</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Events Sertifikat</h1>
    <a href="/admin301097/sistem-sertifikat">&laquo; Kembali</a>
    <a href="/admin301097" class="ms-2">&laquo; Dashboard</a>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Slug</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\CertificateEvent::limit(20)->get() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->slug }}</td>
                <td>{{ $row->start_date }}</td>
                <td>{{ $row->end_date }}</td>
                <td>{{ $row->status ? 'Aktif' : 'Nonaktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total:</strong> {{ \App\Models\CertificateEvent::count() }} events</p>
</body>
</html>