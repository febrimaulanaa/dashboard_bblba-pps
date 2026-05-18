<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - UT Jakarta</title>
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #ecf0f6; }
        
        .app-container { display: flex; min-height: 100vh; }
        
        .sidebar { width: 260px; background: linear-gradient(180deg, #1e3a5f 0%, #0d253f 100%); color: white; position: fixed; height: 100vh; overflow-y: auto; z-index: 1000; transition: transform 0.3s ease; }
        .sidebar-brand { padding: 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-brand .logo { width: 40px; height: 40px; background: #fff; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1e3a5f; font-weight: bold; }
        .sidebar-brand .text h4 { font-size: 16px; font-weight: 600; margin: 0; }
        .sidebar-brand .text span { font-size: 11px; opacity: 0.7; }
        .sidebar-menu { padding: 15px 0; }
        .sidebar-section { margin-bottom: 20px; }
        .sidebar-section-title { padding: 8px 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; margin-bottom: 0; }
        .sidebar-link { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.2s; border-left: 3px solid transparent; cursor: pointer; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(255,255,255,0.1); color: #fff; border-left-color: #3498db; text-decoration: none; }
        .sidebar-link .icon { width: 20px; text-align: center; }
        
        .main-content { flex: 1; margin-left: 260px; transition: margin-left 0.3s ease; width: calc(100% - 260px); }
        
        .topbar { background: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 999; }
        .topbar-title { font-size: 20px; font-weight: 600; color: #2c3e50; margin: 0; display: flex; align-items: center; }
        .topbar-user { display: flex; align-items: center; gap: 12px; }
        .topbar-user .avatar { width: 36px; height: 36px; background: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; }
        
        .content-area { padding: 30px; min-height: calc(100vh - 70px); }
        
        /* Make sidebar toggleable on desktop too if needed, but definitely on mobile */
        .menu-toggle { font-size: 20px; cursor: pointer; color: #2c3e50; display: none; }
        
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 998; }
        
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; }
            .menu-toggle { display: block; }
            .topbar { padding: 15px 20px; }
            .content-area { padding: 15px; }
            .sidebar-overlay.show { display: block; }
        }
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
                    <a href="/admin301097" class="sidebar-link">
                        <span class="icon"><i class="fas fa-home"></i></span> Kembali ke Dashboard
                    </a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Lainnya</div>
                    <a href="/admin301097" class="sidebar-link active">
                        <span class="icon"><i class="fas fa-certificate"></i></span> Sistem Sertifikat
                    </a>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></span>
                    <h2 class="topbar-title">@yield('title', 'Admin Panel')</h2>
                </div>
                <div class="topbar-user">
                    <span class="d-none d-sm-inline">Administrator</span>
                    <div class="avatar">A</div>
                </div>
            </div>
            
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
    </script>
</body>
</html>