@extends('backend.layout-admin')
@section('title', 'Dashboard Sertifikat')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Sistem Manajemen Sertifikat</h4>
            <span class="text-muted">Kelola kegiatan, template, dan peserta sertifikat secara otomatis.</span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Kegiatan</p>
                                <h4 class="card-title">{{ $stats['total_events'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Kegiatan Aktif</p>
                                <h4 class="card-title">{{ $stats['active_events'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Peserta</p>
                                <h4 class="card-title">{{ $stats['total_participants'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Sertifikat Terkirim</p>
                                <h4 class="card-title">{{ $stats['sent_emails'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-body text-center p-4">
                    <div class="avatar avatar-xxl mt-2 mb-3">
                        <span class="avatar-title rounded-circle border border-white bg-primary"><i class="fas fa-calendar-alt fa-2x"></i></span>
                    </div>
                    <h3 class="mb-1 font-weight-bold">Kegiatan</h3>
                    <p class="text-muted mb-4">Buat kegiatan untuk generate form pendaftaran & sertifikat</p>
                    <a href="{{ route('admin.sertifikat.events') }}" class="btn btn-primary btn-round btn-sm px-4">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-body text-center p-4">
                    <div class="avatar avatar-xxl mt-2 mb-3">
                        <span class="avatar-title rounded-circle border border-white bg-secondary"><i class="fas fa-paint-brush fa-2x"></i></span>
                    </div>
                    <h3 class="mb-1 font-weight-bold">Template Sertifikat</h3>
                    <p class="text-muted mb-4">Kelola background & posisi teks (X/Y) sertifikat</p>
                    <a href="{{ route('admin.sertifikat.templates') }}" class="btn btn-secondary btn-round btn-sm px-4">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-body text-center p-4">
                    <div class="avatar avatar-xxl mt-2 mb-3">
                        <span class="avatar-title rounded-circle border border-white bg-info"><i class="fas fa-users fa-2x"></i></span>
                    </div>
                    <h3 class="mb-1 font-weight-bold">Data Peserta</h3>
                    <p class="text-muted mb-4">Lihat data peserta, download PDF, atau kirim ulang email</p>
                    <a href="{{ route('admin.sertifikat.participants') }}" class="btn btn-info btn-round btn-sm px-4">Kelola</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
