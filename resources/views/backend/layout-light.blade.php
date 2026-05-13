<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin UT Jakarta</title>
    <style>
        * { margin: 0; padding: box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #006191; color: white; padding: 15px 20px; }
        .header h3 { font-weight: 600; }
        .wrap { display: flex; min-height: 100vh; }
        .sidebar { width: 220px; background: white; border-right: 1px solid #ddd; }
        .sidebar h4 { padding: 15px; color: #006191; border-bottom: 1px solid #eee; margin: 0; }
        .sidebar a { display: block; padding: 10px 15px; color: #333; text-decoration: none; border-bottom: 1px solid #f5f5f5; }
        .sidebar a:hover { background: #f0f4f8; }
        .content { flex: 1; padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 5px; margin-bottom: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .stats { display: flex; gap: 15px; flex-wrap: wrap; }
        .stat-box { background: white; padding: 15px 20px; border-radius: 5px; flex: 1; min-width: 120px; text-align: center; }
        .stat-box h2 { color: #006191; font-size: 24px; margin: 0; }
        .stat-box p { color: #666; font-size: 12px; margin: 5px 0 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px 10px; border: 1px solid #ddd; text-align: left; font-size: 13px; }
        th { background: #006191; color: white; }
        .btn { padding: 5px 10px; background: #006191; color: white; text-decoration: none; border-radius: 3px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h3>Dashboard Admin UT Jakarta</h3>
    </div>
    <div class="wrap">
        <div class="sidebar">
            <h4>Menu</h4>
            <a href="/admin301097">Dashboard</a>
            <a href="/admin301097/pkbjj">PKBJJ</a>
            <a href="/admin301097/osmb">OSMB</a>
            <a href="/admin301097/seminar">Seminar</a>
            <a href="/admin301097/wtku">WTKU</a>
            <a href="/admin301097/wisuda">Wisuda</a>
            <a href="/admin301097/tuweb">Tuweb</a>
            <a href="/admin301097/jadwalpkbjj">Jadwal PKBJJ</a>
            <a href="/admin301097/users">Pegawai</a>
            <a href="/admin301097/absensi">Absensi</a>
            <a href="/admin301097/sistem-sertifikat">Sertifikat</a>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>