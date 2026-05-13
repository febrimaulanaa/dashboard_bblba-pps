<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UT Jakarta</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; }
        
        /* Top Header */
        .topbar { background: #fff; height: 60px; display: flex; align-items: center; justify-content: space-between; padding: 0 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); position: fixed; top: 0; left: 0; right: 0; z-index: 1000; }
        .topbar-logo { display: flex; align-items: center; gap: 12px; }
        .topbar-logo h4 { color: #006191; font-weight: 700; }
        .topbar-logo span { background: #006191; color: white; padding: 8px 12px; border-radius: 6px; font-size: 14px; font-weight: 600; }
        .topbar-user { display: flex; align-items: center; gap: 15px; }
        .topbar-user .avatar { width: 36px; height: 36px; background: #006191; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; }
        
        /* Sidebar */
        .sidebar { position: fixed; top: 60px; left: 0; bottom: 0; width: 260px; background: #1a1a2e; color: white; overflow-y: auto; }
        .sidebar-section { padding: 20px 0 10px; }
        .sidebar-title { padding: 0 20px 8px; font-size: 11px; text-transform: uppercase; color: #6c7293; letter-spacing: 1px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #aeb9e1; text-decoration: none; transition: all 0.2s; border-left: 3px solid transparent; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: #25253d; color: white; border-left-color: #006191; }
        .sidebar-menu a .icon { width: 20px; text-align: center; }
        
        /* Main Content */
        .main { margin-left: 260px; margin-top: 60px; padding: 25px; min-height: calc(100vh - 60px); }
        
        /* Page Title */
        .page-header { margin-bottom: 25px; }
        .page-header h1 { font-size: 24px; font-weight: 600; color: #1a1a2e; }
        .page-header .breadcrumb { font-size: 13px; color: #6c7293; margin-top: 5px; }
        
        /* Cards */
        .card { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        
        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 25px; }
        .stat-card { background: white; border-radius: 10px; padding: 20px; display: flex; align-items: center; gap: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .stat-icon.blue { background: #e3f2fd; color: #1976d2; }
        .stat-icon.green { background: #e8f5e9; color: #388e3c; }
        .stat-icon.orange { background: #fff3e0; color: #f57c00; }
        .stat-icon.purple { background: #f3e5f5; color: #7b1fa2; }
        .stat-info h3 { font-size: 24px; font-weight: 700; color: #1a1a2e; }
        .stat-info p { font-size: 13px; color: #6c7293; margin: 0; }
        
        /* Tables */
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 12px 15px; text-align: left; font-weight: 600; color: #1a1a2e; font-size: 13px; border-bottom: 2px solid #e9ecef; }
        td { padding: 12px 15px; border-bottom: 1px solid #e9ecef; color: #444; font-size: 13px; }
        tr:hover { background: #f8f9fa; }
        
        /* Buttons */
        .btn { padding: 8px 16px; border-radius: 6px; text-decoration: none; display: inline-block; font-size: 13px; font-weight: 500; cursor: pointer; border: none; }
        .btn-primary { background: #006191; color: white; }
        .btn-primary:hover { background: #005377; }
        .btn-secondary { background: #6c7293; color: white; }
        
        /* Quick Links */
        .quick-links { display: flex; flex-wrap: wrap; gap: 10px; }
        .quick-link { padding: 10px 18px; background: #f8f9fa; border-radius: 6px; color: #1a1a2e; text-decoration: none; font-size: 13px; transition: all 0.2s; }
        .quick-link:hover { background: #006191; color: white; }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="topbar">
        <div class="topbar-logo">
            <span>UTJ</span>
            <h4>Universitas Terbuka Jakarta</h4>
        </div>
        <div class="topbar-user">
            <span>Admin</span>
            <div class="avatar">A</div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-section">
            <div class="sidebar-title">Main</div>
            <div class="sidebar-menu">
                <a href="/admin301097" class="{{ Request::path() == 'admin301097' ? 'active' : '' }}">
                    <span class="icon">&#9632;</span> Dashboard
                </a>
            </div>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-title">Data Sertifikat</div>
            <div class="sidebar-menu">
                <a href="/admin301097/pkbjj" class="{{ Request::path() == 'admin301097/pkbjj' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> PKBJJ
                </a>
                <a href="/admin301097/osmb" class="{{ Request::path() == 'admin301097/osmb' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> OSMB
                </a>
                <a href="/admin301097/seminar" class="{{ Request::path() == 'admin301097/seminar' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> Seminar
                </a>
                <a href="/admin301097/wtku" class="{{ Request::path() == 'admin301097/wtku' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> WTKU
                </a>
            </div>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-title">Jadwal</div>
            <div class="sidebar-menu">
                <a href="/admin301097/jadwalpkbjj" class="{{ Request::path() == 'admin301097/jadwalpkbjj' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> Jadwal PKBJJ
                </a>
                <a href="/admin301097/tuweb" class="{{ Request::path() == 'admin301097/tuweb' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> Jadwal Tuweb
                </a>
            </div>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-title">Kepegawaian</div>
            <div class="sidebar-menu">
                <a href="/admin301097/users" class="{{ Request::path() == 'admin301097/users' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> Pegawai
                </a>
                <a href="/admin301097/absensi" class="{{ Request::path() == 'admin301097/absensi' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> Absensi
                </a>
            </div>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-title">Lainnya</div>
            <div class="sidebar-menu">
                <a href="/admin301097/wisuda" class="{{ Request::path() == 'admin301097/wisuda' ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> Wisuda
                </a>
                <a href="/admin301097/sistem-sertifikat" class="{{ Request::is('admin301097/sistem-sertifikat*') ? 'active' : '' }}">
                    <span class="icon">&#9744;</span> Sistem Sertifikat
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main">
        <div class="page-header">
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="breadcrumb">Dashboard / {{ Request::path() == 'admin301097' ? 'Overview' : ucfirst(Request::segment(2)) }}</div>
        </div>
        
        @yield('content')
    </div>
</body>
</html>