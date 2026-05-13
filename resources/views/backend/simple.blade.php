<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    <style>
        body { padding: 20px; font-family: sans-serif; }
        .card { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 8px; }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div class="card">
        <h3>Menu:</h3>
        <ul>
            <li><a href="/admin301097/pkbjj">Data PKBJJ</a></li>
            <li><a href="/admin301097/osmb">Data OSMB</a></li>
            <li><a href="/admin301097/seminar">Data Seminar</a></li>
            <li><a href="/admin301097/wtku">Data WTKU</a></li>
            <li><a href="/admin301097/wisuda">Data Wisuda</a></li>
            <li><a href="/admin301097/tuweb">Data Tuweb</a></li>
            <li><a href="/admin301097/users">Manajemen Pegawai</a></li>
        </ul>
    </div>
    <div class="card">
        <h3>Statistik:</h3>
        <p>PKBJJ: {{ \App\Models\DataSertifMhs::count() }}</p>
        <p>OSMB: {{ \App\Models\DataSertifOSMB::count() }}</p>
        <p>Wisuda: {{ \App\Models\Wisuda::count() }}</p>
    </div>
</body>
</html>