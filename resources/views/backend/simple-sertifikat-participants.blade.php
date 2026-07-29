<!DOCTYPE html>
<html>
<head>
    <title>Peserta Sertifikat</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    @include('partials.analytics')
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Data Peserta Sertifikat</h1>
    <a href="/admin301097/sistem-sertifikat">&laquo; Kembali</a>
    <a href="/admin301097" class="ms-2">&laquo; Dashboard</a>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Event</th>
                <th>Verification Code</th>
                <th>Email Sent</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach(\App\Models\CertificateParticipant::limit(20)->get() as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->event_id }}</td>
                <td>{{ $row->verification_code }}</td>
                <td>{{ $row->email_sent ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total:</strong> {{ \App\Models\CertificateParticipant::count() }} participants</p>
</body>
</html>