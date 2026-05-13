<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UT Jakarta</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #ecf0f6; }
        
        .app-container { display: flex; min-height: 100vh; }
        
        .sidebar { width: 260px; background: linear-gradient(180deg, #1e3a5f 0%, #0d253f 100%); color: white; position: fixed; height: 100vh; overflow-y: auto; z-index: 1000; }
        .sidebar-brand { padding: 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-brand .logo { width: 40px; height: 40px; background: #fff; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1e3a5f; font-weight: bold; }
        .sidebar-brand .text h4 { font-size: 16px; font-weight: 600; }
        .sidebar-brand .text span { font-size: 11px; opacity: 0.7; }
        .sidebar-menu { padding: 15px 0; }
        .sidebar-section { margin-bottom: 20px; }
        .sidebar-section-title { padding: 8px 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; }
        .sidebar-link { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.2s; border-left: 3px solid transparent; cursor: pointer; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(255,255,255,0.1); color: #fff; border-left-color: #3498db; }
        .sidebar-link .icon { width: 20px; text-align: center; }
        
        .main-content { flex: 1; margin-left: 260px; }
        
        .topbar { background: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 999; }
        .topbar-title { font-size: 20px; font-weight: 600; color: #2c3e50; }
        .topbar-user { display: flex; align-items: center; gap: 12px; }
        .topbar-user .avatar { width: 36px; height: 36px; background: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; }
        
        .content-area { padding: 30px; min-height: calc(100vh - 70px); }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: #fff; border-radius: 10px; padding: 25px; display: flex; align-items: center; gap: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-icon { width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .stat-icon.blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .stat-icon.green { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; }
        .stat-icon.orange { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
        .stat-icon.purple { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
        .stat-icon.red { background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); color: white; }
        .stat-icon.teal { background: linear-gradient(135deg, #00d2d3 0%, #01a3a4 100%); color: white; }
        .stat-info h3 { font-size: 28px; font-weight: 700; color: #2c3e50; }
        .stat-info p { font-size: 14px; color: #7f8c8d; margin-top: 5px; }
        
        .data-card { background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden; }
        .data-card-header { padding: 20px; border-bottom: 1px solid #ecf0f6; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .data-card-header h3 { font-size: 16px; font-weight: 600; color: #2c3e50; margin: 0; }
        .data-card-body { padding: 0; }
        
        .btn { padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; font-size: 13px; font-weight: 500; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-success { background: #27ae60; color: white; }
        .btn-success:hover { background: #219a52; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-danger:hover { background: #c0392b; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px; border-bottom: 2px solid #ecf0f6; }
        td { padding: 15px; border-bottom: 1px solid #ecf0f6; color: #555; font-size: 13px; }
        tr:hover { background: #f8f9fa; }
        
        .breadcrumb { display: flex; gap: 8px; font-size: 13px; color: #95a5a6; margin-top: 5px; }
        .breadcrumb a { color: #3498db; text-decoration: none; }
        
        .loading { text-align: center; padding: 40px; color: #7f8c8d; }
        .loading i { font-size: 24px; animation: spin 1s linear infinite; }
        
        @keyframes spin { 100% { transform: rotate(360deg); } }
        
        .collapse { display: none; }
        .collapse.show { display: block; }
        
        .menu-toggle { display: none; font-size: 24px; cursor: pointer; }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .menu-toggle { display: block; }
            .topbar { padding: 15px; }
            .content-area { padding: 15px; }
            .stats-grid { grid-template-columns: 1fr; }
            .data-card-header { flex-direction: column; align-items: flex-start; }
            .data-card-header .btn { margin-top: 10px; }
            table { display: block; overflow-x: auto; }
            .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 999; }
            .sidebar-overlay.show { display: block; }
        }
        
        .sidebar .collapse { display: none; }
        .sidebar .collapse.in { display: block; }
    </style>
</head>
<body>
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    
    <div class="app-container">
        <div class="sidebar" id="sidebar">
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
                    <a href="#" class="sidebar-link" onclick="loadPage('dashboard', event)">
                        <span class="icon"><i class="fas fa-home"></i></span> Dashboard
                    </a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Data Sertifikat</div>
                    <a href="#" class="sidebar-link" onclick="loadPage('pkbjj', event)">
                        <span class="icon"><i class="fas fa-file-alt"></i></span> PKBJJ
                    </a>
                    <a href="#" class="sidebar-link" onclick="loadPage('osmb', event)">
                        <span class="icon"><i class="fas fa-file-alt"></i></span> OSMB
                    </a>
                    <a href="#" class="sidebar-link" onclick="loadPage('seminar', event)">
                        <span class="icon"><i class="fas fa-file-alt"></i></span> Seminar
                    </a>
                    <a href="#" class="sidebar-link" onclick="loadPage('wtku', event)">
                        <span class="icon"><i class="fas fa-file-alt"></i></span> WTKU
                    </a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Jadwal</div>
                    <a href="#" class="sidebar-link" onclick="loadPage('jadwalpkbjj', event)">
                        <span class="icon"><i class="fas fa-calendar"></i></span> Jadwal PKBJJ
                    </a>
                    <a href="#" class="sidebar-link" onclick="loadPage('tuweb', event)">
                        <span class="icon"><i class="fas fa-calendar"></i></span> Jadwal Tuweb
                    </a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Kepegawaian</div>
                    <a href="#" class="sidebar-link" onclick="loadPage('users', event)">
                        <span class="icon"><i class="fas fa-users"></i></span> Pegawai
                    </a>
                    <a href="#" class="sidebar-link" onclick="loadPage('absensi', event)">
                        <span class="icon"><i class="fas fa-clock"></i></span> Absensi
                    </a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Lainnya</div>
                    <a href="#" class="sidebar-link" onclick="loadPage('wisuda', event)">
                        <span class="icon"><i class="fas fa-graduation-cap"></i></span> Wisuda
                    </a>
                    <a href="#" class="sidebar-link" onclick="loadPage('sistem-sertifikat', event)">
                        <span class="icon"><i class="fas fa-certificate"></i></span> Sistem Sertifikat
                    </a>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></span>
                    <div class="topbar-title">
                        <span id="page-title">Dashboard</span>
                        <div class="breadcrumb">
                            <a href="#" onclick="loadPage('dashboard', event)">Home</a>
                            <span>/</span>
                            <span id="breadcrumb">Overview</span>
                        </div>
                    </div>
                </div>
                <div class="topbar-user">
                    <span>Administrator</span>
                    <div class="avatar">A</div>
                </div>
            </div>
            
            <div class="content-area" id="content-area">
                <div class="loading"><i class="fas fa-spinner"></i> Loading...</div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleSidebar() {
            $('#sidebar').toggleClass('show');
            $('.sidebar-overlay').toggleClass('show');
        }

        function loadPage(page, event) {
            if (event) event.preventDefault();
            
            $('.sidebar-link').removeClass('active');
            $(event.target).closest('.sidebar-link').addClass('active');
            
            var title = page.charAt(0).toUpperCase() + page.slice(1).replace(/-/g, ' ');
            $('#page-title').text(title);
            $('#breadcrumb').text(title);
            
            $('#content-area').html('<div class="loading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
            
            if (window.innerWidth <= 768) {
                $('#sidebar').removeClass('show');
                $('.sidebar-overlay').removeClass('show');
            }
            
            $.ajax({
                url: '/admin301097/ajax/' + page,
                type: 'GET',
                success: function(response) {
                    $('#content-area').html(response);
                },
                error: function() {
                    $('#content-area').html('<div class="loading">Error loading content</div>');
                }
            });
        }

        $(document).ready(function() {
            loadPage('dashboard');
        });
    </script>
</body>
</html>