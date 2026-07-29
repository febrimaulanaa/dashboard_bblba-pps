<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    @include('partials.analytics')
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
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-home"></i></span> Dashboard Utama
                    </a>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-section-title">Data Akademik</div>
                    <a href="{{ route('admin.pkbjj') }}" class="sidebar-link {{ request()->routeIs('admin.pkbjj') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-file-alt"></i></span> Data LPKBJJ
                    </a>
                    <a href="{{ route('admin.osmb') }}" class="sidebar-link {{ request()->routeIs('admin.osmb') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-file-alt"></i></span> Data OSMB
                    </a>
                    <a href="{{ route('admin.seminar') }}" class="sidebar-link {{ request()->routeIs('admin.seminar') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-file-alt"></i></span> Data Seminar
                    </a>
                    <a href="{{ route('admin.wtku') }}" class="sidebar-link {{ request()->routeIs('admin.wtku') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-file-alt"></i></span> Data WTKU
                    </a>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-section-title">Jadwal</div>
                    <a href="{{ route('admin.jadwalpkbjj') }}" class="sidebar-link {{ request()->routeIs('admin.jadwalpkbjj') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-calendar"></i></span> Jadwal LPKBJJ
                    </a>
                    <a href="{{ route('admin.tuweb') }}" class="sidebar-link {{ request()->routeIs('admin.tuweb') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-calendar"></i></span> Jadwal Tuweb
                    </a>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-section-title">Kepegawaian</div>
                    <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-users"></i></span> Pegawai
                    </a>
                    <a href="{{ route('admin.absensi') }}" class="sidebar-link {{ request()->routeIs('admin.absensi') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-clock"></i></span> Absensi
                    </a>
                </div>
                
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Lainnya</div>
                    <a href="{{ route('admin.wisuda') }}" class="sidebar-link {{ request()->routeIs('admin.wisuda') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-graduation-cap"></i></span> Wisuda
                    </a>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-section-title">Sertifikat Kegiatan</div>
                    <a href="{{ route('admin.sertifikat.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.sertifikat.dashboard') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-chart-pie"></i></span> Overview
                    </a>
                    <a href="{{ route('admin.sertifikat.events') }}" class="sidebar-link {{ request()->routeIs('admin.sertifikat.events*') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-calendar-alt"></i></span> Kelola Kegiatan
                    </a>
                    <a href="{{ route('admin.sertifikat.templates') }}" class="sidebar-link {{ request()->routeIs('admin.sertifikat.templates*') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-paint-brush"></i></span> Template Sertifikat
                    </a>
                    <a href="{{ route('admin.sertifikat.participants') }}" class="sidebar-link {{ request()->routeIs('admin.sertifikat.participants*') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-users"></i></span> Data Peserta
                    </a>
                </div>
                @if(session('admin_role') == 'superadmin')
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Manajemen Admin</div>
                    <a href="{{ route('admin.admins.index') }}" class="sidebar-link {{ Request::is('admin301097/admins*') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-user-shield"></i></span> Akun Admin
                    </a>
                </div>
                @endif
            </div>
        </div>
        
        <div class="main-content">
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></span>
                    <h2 class="topbar-title">@yield('title', 'Admin Panel')</h2>
                </div>
                <div class="topbar-user" style="display: flex; align-items: center; gap: 15px;">
                    <span class="d-none d-sm-inline">Administrator</span>
                    <div class="avatar">A</div>
                    <form action="{{ route('admin.logout') }}" method="POST" style="margin-bottom: 0;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" style="padding: 5px 10px; font-size: 12px; height: 36px; display: flex; align-items: center;">Logout</button>
                    </form>
                </div>
            </div>
            
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('atlantis/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/core/bootstrap.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('atlantis/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
    </script>
</body>
</html>