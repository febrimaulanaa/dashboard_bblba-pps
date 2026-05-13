<!DOCTYPE html>
<html>
<head>
    <title>Sistem Sertifikat</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
</head>
<body style="padding:20px;font-family:sans-serif;">
    <h1>Sistem Manajemen Sertifikat</h1>
    <a href="/admin301097">&laquo; Kembali</a>
    
    <div class="mt-4">
        <h3>Menu:</h3>
        <ul>
            <li><a href="/admin301097/sistem-sertifikat/events">Events / Kegiatan</a></li>
            <li><a href="/admin301097/sistem-sertifikat/templates">Templates</a></li>
            <li><a href="/admin301097/sistem-sertifikat/participants">Data Peserta</a></li>
        </ul>
    </div>
    
    <div class="mt-4">
        <h3>Statistik:</h3>
        <ul>
            <li>Total Events: {{ \App\Models\CertificateEvent::count() }}</li>
            <li>Events Aktif: {{ \App\Models\CertificateEvent::where('status', true)->count() }}</li>
            <li>Total Peserta: {{ \App\Models\CertificateParticipant::count() }}</li>
            <li>Email Terkirim: {{ \App\Models\CertificateParticipant::where('email_sent', true)->count() }}</li>
        </ul>
    </div>
</body>
</html>