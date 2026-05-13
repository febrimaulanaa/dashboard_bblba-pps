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
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #ecf0f6; }
        
        /* Layout */
        .app-container { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: linear-gradient(180deg, #1e3a5f 0%, #0d253f 100%); color: white; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar-brand { padding: 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-brand .logo { width: 40px; height: 40px; background: #fff; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1e3a5f; font-weight: bold; }
        .sidebar-brand .text h4 { font-size: 16px; font-weight: 600; }
        .sidebar-brand .text span { font-size: 11px; opacity: 0.7; }
        .sidebar-menu { padding: 15px 0; }
        .sidebar-section { margin-bottom: 20px; }
        .sidebar-section-title { padding: 8px 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; }
        .sidebar-link { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.2s; border-left: 3px solid transparent; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(255,255,255,0.1); color: #fff; border-left-color: #3498db; }
        .sidebar-link .icon { width: 20px; text-align: center; }
        
        /* Main Content */
        .main-content { flex: 1; margin-left: 260px; }
        
        /* Top Bar */
        .topbar { background: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .topbar-title { font-size: 20px; font-weight: 600; color: #2c3e50; }
        .topbar-user { display: flex; align-items: center; gap: 12px; }
        .topbar-user .avatar { width: 36px; height: 36px; background: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; }
        
        /* Content Area */
        .content-area { padding: 30px; }
        
        /* Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: #fff; border-radius: 10px; padding: 25px; display: flex; align-items: center; gap: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .stat-icon { width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .stat-icon.blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .stat-icon.green { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; }
        .stat-icon.orange { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
        .stat-icon.purple { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
        .stat-info h3 { font-size: 28px; font-weight: 700; color: #2c3e50; }
        .stat-info p { font-size: 14px; color: #7f8c8d; margin-top: 5px; }
        
        /* Data Card */
        .data-card { background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden; }
        .data-card-header { padding: 20px; border-bottom: 1px solid #ecf0f6; display: flex; justify-content: space-between; align-items: center; }
        .data-card-header h3 { font-size: 16px; font-weight: 600; color: #2c3e50; }
        .data-card-body { padding: 0; }
        
        /* Buttons */
        .btn { padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; font-size: 13px; font-weight: 500; cursor: pointer; border: none; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-success { background: #27ae60; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        
        /* Table */
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px; border-bottom: 2px solid #ecf0f6; }
        td { padding: 15px; border-bottom: 1px solid #ecf0f6; color: #555; font-size: 13px; }
        tr:hover { background: #f8f9fa; }
        
        /* Breadcrumb */
        .breadcrumb { display: flex; gap: 8px; font-size: 13px; color: #95a5a6; margin-top: 5px; }
        .breadcrumb a { color: #3498db; text-decoration: none; }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                <div class="logo">UT</div>
                <div class="text">
                    <h4>UT Jakarta</h4>
                    <span>Admin Panel</span>
                </div>
            </div>
            <div class="sidebar-menu">
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Main Menu</div>
                    <a href="/admin301097" class="sidebar-link {{ Request::path() == 'admin301097' ? 'active' : '' }}">
                        <span class="icon">&#9632;</span> Dashboard
                    </a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Data Sertifikat</div>
                    <a href="/admin301097/pkbjj" class="sidebar-link">PKBJJ</a>
                    <a href="/admin301097/osmb" class="sidebar-link">OSMB</a>
                    <a href="/admin301097/seminar" class="sidebar-link">Seminar</a>
                    <a href="/admin301097/wtku" class="sidebar-link">WTKU</a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Jadwal</div>
                    <a href="/admin301097/jadwalpkbjj" class="sidebar-link">Jadwal PKBJJ</a>
                    <a href="/admin301097/tuweb" class="sidebar-link">Jadwal Tuweb</a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Kepegawaian</div>
                    <a href="/admin301097/users" class="sidebar-link">Pegawai</a>
                    <a href="/admin301097/absensi" class="sidebar-link">Absensi</a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Lainnya</div>
                    <a href="/admin301097/wisuda" class="sidebar-link">Wisuda</a>
                    <a href="/admin301097/sistem-sertifikat" class="sidebar-link">Sistem Sertifikat</a>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="topbar-title">
                    @yield('page-title', 'Dashboard')
                    <div class="breadcrumb">
                        <a href="/admin301097">Home</a>
                        <span>/</span>
                        <span>@yield('breadcrumb', 'Dashboard')</span>
                    </div>
                </div>
                <div class="topbar-user">
                    <span>Administrator</span>
                    <div class="avatar">A</div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>