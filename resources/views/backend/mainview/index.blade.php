@extends('backend.template.modern')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Hero Header Pattern -->
    <section class="mb-12 relative overflow-hidden rounded-3xl bg-primary h-64 flex flex-col justify-center px-12 text-on-primary">
        <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuATU0BbCgwkjf2f40mxH-8uiIjYi1hrvkncZ0t7UOUbY_6lY0rvWnnK5zASBQKEnk6eRYeqYTPaz5uhDqc5nWN4eqyNsxNcRvnlSN9I4eN0S_JBAxkYsE0IRqNI7Udm3EBTKUPaiMPoNGXSdKdrajZzvVv0Ghq_4VnGb37G8BtyStwD_GtEfrQPUSqSP0Ss9D-qoutNWnSj5yJHrG-VGAJofDGi9nz3_uo6S8SGuJLzZEWCPEamUbxwvcggt5N7r0EYqtx5br9uBs6Z'); background-size: cover; background-position: center;">
        </div>
        <div class="relative z-10">
            <span class="inline-block py-1 px-3 bg-secondary-container text-on-secondary-container text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Dashboard Overview</span>
            <h1 class="text-4xl md:text-5xl font-display font-bold tracking-tight mb-2">Welcome, Admin</h1>
            <p class="text-primary-fixed max-w-lg font-body opacity-90">Central control panel for managing UT Jakarta's academic activities, tutorial schedules, and student data monitoring.</p>
        </div>
    </section>

    <!-- Statistics Grid -->
    <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 -mt-20 relative z-20">
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_12px_32px_rgba(24,28,32,0.04)] border border-outline-variant/10 hover:shadow-lg transition-all duration-300">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Mhs PKBJJ</p>
            <p class="text-3xl font-headline font-black text-primary">{{ \App\Models\DataSertifMhs::count() }}</p>
            <div class="mt-2 flex items-center gap-1 text-green-600">
                <span class="material-symbols-outlined text-sm">groups</span>
                <span class="text-xs font-bold">Total Terdaftar</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_12px_32px_rgba(24,28,32,0.04)] border border-outline-variant/10 hover:shadow-lg transition-all duration-300">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Mhs OSMB</p>
            <p class="text-3xl font-headline font-black text-primary">{{ \App\Models\DataSertifOSMB::count() }}</p>
            <div class="mt-2 flex items-center gap-1 text-on-secondary-fixed-variant">
                <span class="material-symbols-outlined text-sm">groups</span>
                <span class="text-xs font-bold">Total Terdaftar</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_12px_32px_rgba(24,28,32,0.04)] border border-outline-variant/10 hover:shadow-lg transition-all duration-300">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Jadwal TUWEB</p>
            <p class="text-3xl font-headline font-black text-primary">{{ \App\Models\JadwalTuweb::count() }}</p>
            <div class="mt-2 flex items-center gap-1 text-tertiary">
                <span class="material-symbols-outlined text-sm">video_camera_front</span>
                <span class="text-xs font-bold">Kelas Aktif</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_12px_32px_rgba(24,28,32,0.04)] border border-outline-variant/10 hover:shadow-lg transition-all duration-300">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Laporan Absensi</p>
            <p class="text-3xl font-headline font-black text-primary">{{ \App\Models\AbsensiPegawai::count() ?? '0' }}</p>
            <div class="mt-2 flex items-center gap-1 text-primary">
                <span class="material-symbols-outlined text-sm">assignment_turned_in</span>
                <span class="text-xs font-bold">Total Disubmit</span>
            </div>
        </div>
    </section>

    <!-- Quick Actions Container -->
    <section class="bg-surface-container-lowest rounded-2xl shadow-[0_12px_32px_rgba(24,28,32,0.04)] border border-outline-variant/10 overflow-hidden mt-8">
        <div class="p-6 bg-surface-container-low/50 border-b border-outline-variant/10">
            <h2 class="text-xl font-headline font-bold text-on-surface">Quick Actions</h2>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('adminpkbjj') }}" class="flex items-center gap-4 p-4 rounded-xl border border-outline-variant/20 hover:bg-surface-container-low transition-all group">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">school</span>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-on-surface mb-1">Kelola Data PKBJJ</h3>
                    <p class="text-xs text-on-surface-variant">Lihat dan atur data mahasiswa</p>
                </div>
            </a>

            <a href="{{ route('adminosmb') }}" class="flex items-center gap-4 p-4 rounded-xl border border-outline-variant/20 hover:bg-surface-container-low transition-all group">
                <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">groups</span>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-on-surface mb-1">Kelola Data OSMB</h3>
                    <p class="text-xs text-on-surface-variant">Lihat dan atur data mahasiswa</p>
                </div>
            </a>

            <a href="{{ route('admintuweb') }}" class="flex items-center gap-4 p-4 rounded-xl border border-outline-variant/20 hover:bg-surface-container-low transition-all group">
                <div class="w-12 h-12 bg-tertiary/10 rounded-lg flex items-center justify-center text-tertiary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">video_camera_front</span>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-on-surface mb-1">Manajemen TUWEB</h3>
                    <p class="text-xs text-on-surface-variant">Update jadwal dan link kelas</p>
                </div>
            </a>
            
            <a href="{{ route('admin.absensi') }}" class="flex items-center gap-4 p-4 rounded-xl border border-outline-variant/20 hover:bg-surface-container-low transition-all group">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">assignment_ind</span>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-on-surface mb-1">Laporan Absensi</h3>
                    <p class="text-xs text-on-surface-variant">Monitoring absensi TTM/TUWEB</p>
                </div>
            </a>
        </div>
    </section>
@endsection
