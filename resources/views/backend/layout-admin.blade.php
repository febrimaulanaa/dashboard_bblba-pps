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
        body { background: #f5f6fa; }
        .main-header { background: #006191; color: white; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; }
        .main-header h3 { margin: 0; font-weight: 600; }
        .main-header a { color: white; text-decoration: none; }
        .sidebar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); height: 100vh; position: fixed; width: 250px; overflow-y: auto; }
        .sidebar-header { padding: 20px; border-bottom: 1px solid #eee; }
        .sidebar-header h4 { margin: 0; color: #006191; font-weight: 700; }
        .sidebar-menu { padding: 10px 0; }
        .sidebar-menu a { display: block; padding: 12px 25px; color: #333; text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: #f0f4f8; border-left-color: #006191; color: #006191; }
        .sidebar-menu a i { margin-right: 10px; width: 20px; }
        .menu-title { padding: 10px 25px 5px; font-size: 11px; text-transform: uppercase; color: #999; font-weight: 600; }
        .content-wrapper { margin-left: 250px; padding: 20px; }
        .page-title { font-size: 24px; font-weight: 600; margin-bottom: 20px; color: #333; }
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px; }
        .stat-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center; }
        .stat-card h2 { margin: 0; font-size: 32px; color: #006191; font-weight: 700; }
        .stat-card p { margin: 5px 0 0; color: #666; font-size: 14px; }
        .stat-card.warning h2 { color: #f39c12; }
        .stat-card.success h2 { color: #27ae60; }
        .stat-card.danger h2 { color: #e74c3c; }
        table.dataTable { width: 100% !important; }
        .btn { padding: 8px 16px; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; }
        .btn-primary { background: #006191; color: white; }
        .btn-success { background: #27ae60; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        .dataTables_wrapper { margin-top: 20px; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="main-header">
        <h3>Dashboard Admin UT Jakarta</h3>
        <div>
            <span>Selamat Datang, Admin</span>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>UT Jakarta</h4>
            <small style="color: #666;">Admin Panel</small>
        </div>
        
        <div class="sidebar-menu">
            <a href="/admin301097" class="{{ Request::path() == 'admin301097' ? 'active' : '' }}">
                <i class="fa fa-home"></i> Dashboard
            </a>
            
            <div class="menu-title">Data Sertifikat</div>
            <a href="/admin301097/pkbjj" class="{{ Request::path() == 'admin301097/pkbjj' ? 'active' : '' }}">
                <i class="fa fa-file-alt"></i> PKBJJ
            </a>
            <a href="/admin301097/osmb" class="{{ Request::path() == 'admin301097/osmb' ? 'active' : '' }}">
                <i class="fa fa-file-alt"></i> OSMB
            </a>
            <a href="/admin301097/seminar" class="{{ Request::path() == 'admin301097/seminar' ? 'active' : '' }}">
                <i class="fa fa-file-alt"></i> Seminar Akademik
            </a>
            <a href="/admin301097/wtku" class="{{ Request::path() == 'admin301097/wtku' ? 'active' : '' }}">
                <i class="fa fa-file-alt"></i> WTKU
            </a>
            
            <div class="menu-title">Jadwal</div>
            <a href="/admin301097/jadwalpkbjj" class="{{ Request::path() == 'admin301097/jadwalpkbjj' ? 'active' : '' }}">
                <i class="fa fa-calendar"></i> Jadwal PKBJJ
            </a>
            <a href="/admin301097/tuweb" class="{{ Request::path() == 'admin301097/tuweb' ? 'active' : '' }}">
                <i class="fa fa-calendar"></i> Jadwal Tuweb
            </a>
            
            <div class="menu-title">Kepegawaian</div>
            <a href="/admin301097/users" class="{{ Request::path() == 'admin301097/users' ? 'active' : '' }}">
                <i class="fa fa-users"></i> Manajemen Pegawai
            </a>
            <a href="/admin301097/absensi" class="{{ Request::path() == 'admin301097/absensi' ? 'active' : '' }}">
                <i class="fa fa-clock"></i> Absensi
            </a>
            
            <div class="menu-title">Lainnya</div>
            <a href="/admin301097/wisuda" class="{{ Request::path() == 'admin301097/wisuda' ? 'active' : '' }}">
                <i class="fa fa-graduation-cap"></i> Wisuda
            </a>
            <a href="/admin301097/sistem-sertifikat" class="{{ Request::is('admin301097/sistem-sertifikat*') ? 'active' : '' }}">
                <i class="fa fa-certificate"></i> Sistem Sertifikat
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('atlantis/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/core/bootstrap.min.js') }}"></script>
    @yield('scripts')
</body>
</html>