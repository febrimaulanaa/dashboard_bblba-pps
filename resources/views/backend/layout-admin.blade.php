<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UT Jakarta</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/fonts.min.css') }}">
    <style>
        body { background: #f5f6fa; margin: 0; }
        .header { background: #006191; color: white; padding: 15px 25px; }
        .header h3 { margin: 0; font-weight: 600; }
        .container { display: flex; }
        .sidebar { background: white; width: 250px; min-height: 100vh; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .sidebar-title { padding: 20px; border-bottom: 1px solid #eee; }
        .sidebar-title h4 { margin: 0; color: #006191; }
        .menu { padding: 10px 0; }
        .menu a { display: block; padding: 12px 25px; color: #333; text-decoration: none; }
        .menu a:hover, .menu a.active { background: #f0f4f8; border-left: 3px solid #006191; color: #006191; }
        .menu-title { padding: 10px 25px 5px; font-size: 11px; text-transform: uppercase; color: #999; }
        .main { flex: 1; padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .stats { display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 20px; }
        .stat { background: white; padding: 20px; border-radius: 8px; flex: 1; min-width: 150px; text-align: center; }
        .stat h2 { margin: 0; color: #006191; font-size: 28px; }
        .stat p { margin: 5px 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #006191; color: white; }
        .btn { padding: 8px 16px; border-radius: 4px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #006191; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h3>Dashboard Admin UT Jakarta</h3>
    </div>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-title">
                <h4>UT Jakarta</h4>
            </div>
            <div class="menu">
                <a href="/admin301097" class="{{ Request::path() == 'admin301097' ? 'active' : '' }}">Dashboard</a>
                <div class="menu-title">Data Sertifikat</div>
                <a href="/admin301097/pkbjj">PKBJJ</a>
                <a href="/admin301097/osmb">OSMB</a>
                <a href="/admin301097/seminar">Seminar</a>
                <a href="/admin301097/wtku">WTKU</a>
                <div class="menu-title">Jadwal</div>
                <a href="/admin301097/jadwalpkbjj">Jadwal PKBJJ</a>
                <a href="/admin301097/tuweb">Tuweb</a>
                <div class="menu-title">Kepegawaian</div>
                <a href="/admin301097/users">Pegawai</a>
                <a href="/admin301097/absensi">Absensi</a>
                <div class="menu-title">Lainnya</div>
                <a href="/admin301097/wisuda">Wisuda</a>
                <a href="/admin301097/sistem-sertifikat">Sertifikat</a>
            </div>
        </div>
        <div class="main">
            @yield('content')
        </div>
    </div>
</body>
</html>