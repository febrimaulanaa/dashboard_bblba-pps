@extends('backend.template.modern')
@section('title', 'Dashboard Sertifikat')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="font-headline font-bold text-2xl text-on-surface">Sistem Manajemen Sertifikat</h2>
        <p class="text-outline">Kelola kegiatan, template, dan peserta sertifikat secara otomatis.</p>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-3 mb-4">
        <div class="card card-stats card-round bg-surface-container-lowest border-0 shadow-sm rounded-2xl h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center bubble-shadow-small bg-primary-container text-primary rounded-xl d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <span class="material-symbols-outlined" style="font-size: 30px;">event</span>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category text-outline font-semibold mb-0">Total Kegiatan</p>
                            <h4 class="card-title text-on-surface font-headline font-bold mb-0" style="font-size: 24px;">{{ $stats['total_events'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 mb-4">
        <div class="card card-stats card-round bg-surface-container-lowest border-0 shadow-sm rounded-2xl h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center bubble-shadow-small bg-success text-white rounded-xl d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <span class="material-symbols-outlined" style="font-size: 30px;">event_available</span>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category text-outline font-semibold mb-0">Kegiatan Aktif</p>
                            <h4 class="card-title text-on-surface font-headline font-bold mb-0" style="font-size: 24px;">{{ $stats['active_events'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 mb-4">
        <div class="card card-stats card-round bg-surface-container-lowest border-0 shadow-sm rounded-2xl h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center bubble-shadow-small bg-info text-white rounded-xl d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <span class="material-symbols-outlined" style="font-size: 30px;">groups</span>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category text-outline font-semibold mb-0">Total Peserta</p>
                            <h4 class="card-title text-on-surface font-headline font-bold mb-0" style="font-size: 24px;">{{ $stats['total_participants'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 mb-4">
        <div class="card card-stats card-round bg-surface-container-lowest border-0 shadow-sm rounded-2xl h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center bubble-shadow-small bg-warning text-white rounded-xl d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <span class="material-symbols-outlined" style="font-size: 30px;">mail</span>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category text-outline font-semibold mb-0">Sertifikat Terkirim</p>
                            <h4 class="card-title text-on-surface font-headline font-bold mb-0" style="font-size: 24px;">{{ $stats['sent_emails'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <a href="{{ route('admin.sertifikat.events') }}" class="text-decoration-none">
            <div class="card bg-surface-container-lowest border-0 shadow-sm rounded-2xl p-4 d-flex flex-row align-items-center hover:bg-surface-container transition-all">
                <div class="bg-primary-container text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                    <span class="material-symbols-outlined">event_note</span>
                </div>
                <div>
                    <h4 class="font-headline font-bold text-on-surface mb-1">Kegiatan</h4>
                    <p class="text-outline text-sm mb-0">Buat kegiatan untuk generate form pendaftaran & sertifikat</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('admin.sertifikat.templates') }}" class="text-decoration-none">
            <div class="card bg-surface-container-lowest border-0 shadow-sm rounded-2xl p-4 d-flex flex-row align-items-center hover:bg-surface-container transition-all">
                <div class="bg-primary-container text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                    <span class="material-symbols-outlined">design_services</span>
                </div>
                <div>
                    <h4 class="font-headline font-bold text-on-surface mb-1">Template Sertifikat</h4>
                    <p class="text-outline text-sm mb-0">Kelola background & posisi teks sertifikat</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('admin.sertifikat.participants') }}" class="text-decoration-none">
            <div class="card bg-surface-container-lowest border-0 shadow-sm rounded-2xl p-4 d-flex flex-row align-items-center hover:bg-surface-container transition-all">
                <div class="bg-primary-container text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                    <span class="material-symbols-outlined">manage_accounts</span>
                </div>
                <div>
                    <h4 class="font-headline font-bold text-on-surface mb-1">Data Peserta</h4>
                    <p class="text-outline text-sm mb-0">Lihat data peserta, download PDF, atau kirim ulang email</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
