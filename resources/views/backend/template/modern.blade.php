<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Dashboard') | UT Jakarta</title>
    <!-- Bootstrap CSS for Legacy Components -->
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">


    <!-- Core JS Files for Legacy Components (Moved to head for inline scripts) -->
    <script src="{{ asset('atlantis/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/core/bootstrap.min.js') }}"></script>

    <script src="{{ asset('atlantis/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "outline": "#6f7881",
                      "on-secondary-fixed-variant": "#544600",
                      "secondary": "#705d00",
                      "inverse-on-surface": "#edf1f7",
                      "on-secondary-container": "#6e5c00",
                      "secondary-fixed": "#ffe16d",
                      "background": "#f7f9ff",
                      "on-primary-fixed": "#001e30",
                      "error": "#ba1a1a",
                      "on-surface": "#181c20",
                      "surface-tint": "#006495",
                      "on-tertiary": "#ffffff",
                      "surface-container-lowest": "#ffffff",
                      "on-secondary": "#ffffff",
                      "secondary-container": "#fcd400",
                      "on-tertiary-fixed": "#001b3c",
                      "tertiary-container": "#5275ac",
                      "surface-dim": "#d7dae0",
                      "on-primary-fixed-variant": "#004b71",
                      "primary-fixed": "#cbe6ff",
                      "on-primary-container": "#fcfcff",
                      "tertiary-fixed": "#d5e3ff",
                      "surface-container-highest": "#dfe3e9",
                      "on-error": "#ffffff",
                      "on-primary": "#ffffff",
                      "tertiary-fixed-dim": "#a7c8ff",
                      "tertiary": "#385d92",
                      "surface-container-low": "#f0f4fa",
                      "surface-bright": "#f7f9ff",
                      "primary-container": "#007bb6",
                      "on-surface-variant": "#3f4850",
                      "inverse-primary": "#8fcdff",
                      "surface-variant": "#dfe3e9",
                      "inverse-surface": "#2c3135",
                      "on-tertiary-container": "#fefcff",
                      "on-tertiary-fixed-variant": "#1f477b",
                      "error-container": "#ffdad6",
                      "surface-container": "#eaeef4",
                      "secondary-fixed-dim": "#e9c400",
                      "primary-fixed-dim": "#8fcdff",
                      "on-secondary-fixed": "#221b00",
                      "outline-variant": "#bec7d2",
                      "on-error-container": "#93000a",
                      "surface": "#f7f9ff",
                      "on-background": "#181c20",
                      "surface-container-high": "#e5e8ee",
                      "primary": "#006191"
              },
              "borderRadius": {
                      "DEFAULT": "0.125rem",
                      "lg": "0.25rem",
                      "xl": "0.5rem",
                      "full": "0.75rem"
              },
              "fontFamily": {
                      "headline": ["Manrope"],
                      "display": ["Manrope"],
                      "body": ["Inter"],
                      "label": ["Inter"]
              }
            },
          }
        }
    </script>
    
    <!-- Custom CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap');
        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-headline { font-family: 'Manrope', sans-serif; }
        
        /* Stitch Table Basic Styling */
        .stitch-table-wrapper table {
            width: 100%;
            border-collapse: collapse;
        }
        .stitch-table-wrapper table thead th {
            background-color: #ffffff;
            border-bottom: 2px solid rgba(190, 199, 210, 0.1);
            padding: 1.25rem 1rem;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #181c20;
            text-align: left;
        }
        .stitch-table-wrapper table tbody td {
            background-color: #ffffff;
            padding: 1.25rem 1rem;
            border-bottom: 1px solid rgba(190, 199, 210, 0.1);
            color: #181c20;
            font-size: 0.875rem;
            vertical-align: middle;
        }
        .stitch-table-wrapper table tbody tr { 
            transition: background-color 0.2s; 
        }
        .stitch-table-wrapper table tbody tr:hover td {
            background-color: #f7f9ff;
        }
    </style>

    <!-- Dummy DataTables Plugin to prevent inline script errors -->
    <script>
        if (typeof jQuery !== 'undefined') {
            jQuery.fn.DataTable = function() { return this; };
            jQuery.fn.dataTable = function() { return this; };
        }
    </script>
    
    <!-- Stitch Table JS -->
    <script src="{{ asset('assets/js/stitch-table.js') }}"></script>
    
    @stack('styles')
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col">
    <!-- TopAppBar -->
    <header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-xl flex justify-between items-center h-16 px-8 max-w-full mx-auto shadow-[0_12px_32px_rgba(24,28,32,0.04)]">
        <div class="flex items-center gap-4">
            <span class="text-xl font-headline font-black tracking-tight text-primary">Admin UT Jakarta</span>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-primary font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-1 after:bg-secondary after:rounded-full font-body text-label-md tracking-wider" href="/admin301097">Dashboard</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-body text-label-md tracking-wider" href="{{ route('home') }}" target="_blank">View Site</a>
        </nav>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <span class="text-sm font-bold text-on-surface-variant hidden md:block">Febri</span>
                <div class="h-8 w-8 rounded-full bg-primary-container overflow-hidden border border-outline-variant/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-sm">person</span>
                </div>
            </div>
        </div>
    </header>

    <div class="flex pt-16 flex-1">
        <!-- SideNavBar -->
        <aside class="fixed left-0 top-16 h-[calc(100vh-64px)] w-64 bg-surface-container-low flex flex-col py-6 gap-2 overflow-y-auto">
            <div class="px-6 mb-6">
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-on-primary">
                        <span class="material-symbols-outlined">dashboard</span>
                    </div>
                    <span class="text-lg font-headline font-bold text-on-surface">Menu Utama</span>
                </div>
            </div>
            
            <nav class="flex-1 space-y-1">
                <a class="{{ request()->is('admin301097') ? 'bg-surface-container-highest text-primary rounded-r-full font-bold shadow-sm translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high' }} flex items-center gap-3 px-6 py-3 transition-all font-body text-sm" href="/admin301097">
                    <span class="material-symbols-outlined">home</span>
                    <span>Dashboard</span>
                </a>
                
                <div class="pt-4 mt-4 border-t border-outline-variant/20 px-6">
                    <p class="text-[10px] uppercase tracking-widest text-outline mb-2">Data Mahasiswa</p>
                    <div class="space-y-1 -mx-2">
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="#">
                            <span class="material-symbols-outlined text-lg">school</span>
                            <span>Data PKBJJ</span>
                        </a>
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="#">
                            <span class="material-symbols-outlined text-lg">event</span>
                            <span>Jadwal PKBJJ</span>
                        </a>
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="#">
                            <span class="material-symbols-outlined text-lg">groups</span>
                            <span>Data OSMB</span>
                        </a>
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="#">
                            <span class="material-symbols-outlined text-lg">cast_for_education</span>
                            <span>Data WTKU</span>
                        </a>
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="#">
                            <span class="material-symbols-outlined text-lg">record_voice_over</span>
                            <span>Data Seminar</span>
                        </a>
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="#">
                            <span class="material-symbols-outlined text-lg">video_camera_front</span>
                            <span>Jadwal TUWEB</span>
                        </a>
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="#">
                            <span class="material-symbols-outlined text-lg">workspace_premium</span>
                            <span>Wisuda Daerah</span>
                        </a>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-outline-variant/20 px-6">
                    <p class="text-[10px] uppercase tracking-widest text-outline mb-2">Sertifikat Kegiatan</p>
                    <div class="space-y-1 -mx-2">
                        <a class="{{ request()->routeIs('admin.sertifikat.events*') ? 'bg-surface-container-highest text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} flex items-center gap-3 px-2 py-2 rounded-lg text-sm transition-all" href="{{ route('admin.sertifikat.events') }}">
                            <span class="material-symbols-outlined text-lg">event_available</span>
                            <span>Kelola Event</span>
                        </a>
                        <a class="{{ request()->routeIs('admin.sertifikat.templates*') ? 'bg-surface-container-highest text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} flex items-center gap-3 px-2 py-2 rounded-lg text-sm transition-all" href="{{ route('admin.sertifikat.templates') }}">
                            <span class="material-symbols-outlined text-lg">style</span>
                            <span>Template Sertifikat</span>
                        </a>
                        <a class="{{ request()->routeIs('admin.sertifikat.participants*') ? 'bg-surface-container-highest text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} flex items-center gap-3 px-2 py-2 rounded-lg text-sm transition-all" href="{{ route('admin.sertifikat.participants') }}">
                            <span class="material-symbols-outlined text-lg">recent_actors</span>
                            <span>Data Peserta</span>
                        </a>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-outline-variant/20 px-6">
                    <p class="text-[10px] uppercase tracking-widest text-outline mb-2">Manajemen Pegawai</p>
                    <div class="space-y-1 -mx-2">
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="/admin301097/absensi">
                            <span class="material-symbols-outlined text-lg">assignment_ind</span>
                            <span>Laporan Absensi</span>
                        </a>
                        <a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high px-2 py-2 rounded-lg text-sm" href="#">
                            <span class="material-symbols-outlined text-lg">manage_accounts</span>
                            <span>Data Users</span>
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Canvas -->
        <main class="ml-64 flex-1 p-8 bg-surface w-[calc(100%-16rem)]">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="w-full mt-auto bg-surface-container-lowest flex flex-col md:flex-row justify-between items-center px-12 py-8 border-t border-outline-variant/20 ml-64 z-10 w-[calc(100%-16rem)] relative">
        <div class="mb-4 md:mb-0">
            <p class="font-headline font-bold text-on-surface text-sm mb-1">Universitas Terbuka Jakarta</p>
            <p class="font-body text-xs tracking-normal text-on-surface-variant">© 2024 Universitas Terbuka Jakarta - Unit Program Belajar Jarak Jauh (UPBJJ)</p>
        </div>
    </footer>

    @include('sweetalert::alert')
    @stack('scripts')
</body>
</html>
