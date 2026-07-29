<!DOCTYPE html>
<html>
<head>
    <title>Templates Sertifikat</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    @include('partials.analytics')
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Templates Sertifikat</h1>
    <a href="/admin301097/sistem-sertifikat">&laquo; Kembali</a>
    <a href="/admin301097" class="ms-2">&laquo; Dashboard</a>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Template</th>
                <th>Background</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\CertificateTemplate::limit(20)->get() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->background ?? 'Default' }}</td>
                <td>{{ $row->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total:</strong> {{ \App\Models\CertificateTemplate::count() }} templates</p>
</body>
</html>