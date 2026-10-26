@extends('backend.layout-admin')
@section('title', 'Template Sertifikat Seminar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-dark">
            Edit Template Sertifikat Seminar
        </h3>
        <p class="text-muted mb-0">Atur file background template dan koordinat teks pada sertifikat seminar.</p>
    </div>
    <div class="d-flex">
        @if(@file_exists(public_path('template_sertif/sertifikatseminar.pdf')))
            <a href="{{ Route::has('admin.seminar.template.preview') ? route('admin.seminar.template.preview') : url('admin301097/seminar/template/preview') }}" target="_blank" class="btn btn-outline-info mr-2">
                <i class="fas fa-eye mr-1"></i> Preview Sertifikat
            </a>
        @endif
        <a href="{{ Route::has('admin.seminar') ? route('admin.seminar') : url('admin301097/seminar') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        @if(isset($loadError))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i> {{ $loadError }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(isset($errors) && is_object($errors) && method_exists($errors, 'any') && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ Route::has('admin.seminar.template.update') ? route('admin.seminar.template.update') : url('admin301097/seminar/template') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Basic Info -->
                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Nama Template <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="Template Sertifikat Seminar" readonly>
                    <small class="form-text text-muted mt-1">Template resmi untuk sertifikat seminar mahasiswa.</small>
                </div>
                
                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Background Template (PDF / Gambar JPG / PNG)</label>
                    <input type="file" name="background" class="form-control-file" accept="application/pdf,image/jpeg,image/png,image/jpg">
                    <small class="form-text text-muted mt-1">Format: PDF, JPG, PNG (maks. 10MB). Rekomendasi: Ukuran A4 Landscape (2000x1414px).</small>
                    @if(@file_exists(public_path('template_sertif/sertifikatseminar.pdf')))
                        <div class="mt-2">
                            <a href="{{ asset('template_sertif/sertifikatseminar.pdf') }}?v={{ time() }}" target="_blank" class="text-primary font-weight-bold" style="font-size: 14px;">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Template Saat Ini
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 mb-3 border-bottom pb-2">
                <h4 class="font-weight-bold text-dark mb-1">Pengaturan Koordinat & Ukuran Teks</h4>
                <p class="text-muted mb-0" style="font-size: 14px;">Atur posisi vertikal (Y) dan ukuran font untuk Nama, NIM, serta Program Studi.</p>
            </div>

            <div class="row">
                <!-- Text: Nama Peserta -->
                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Nama Peserta - Posisi Y <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" name="y_nama" class="form-control" value="{{ old('y_nama', is_array($config) ? ($config['y_nama'] ?? 78) : 78) }}" required>
                    <small class="form-text text-muted">Jarak vertikal dari atas halaman (default: 78).</small>
                </div>
                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Ukuran Font Nama <span class="text-danger">*</span></label>
                    <input type="number" step="1" name="font_size_nama" class="form-control" value="{{ old('font_size_nama', is_array($config) ? ($config['font_size_nama'] ?? 25) : 25) }}" required>
                    <small class="form-text text-muted">Ukuran teks nama dalam satuan pt (default: 25).</small>
                </div>
            </div>

            <div class="row">
                <!-- Text: NIM -->
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">NIM - Posisi Y <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" name="y_nim" class="form-control" value="{{ old('y_nim', is_array($config) ? ($config['y_nim'] ?? 92) : 92) }}" required>
                    <small class="form-text text-muted">Jarak vertikal NIM dari atas (default: 92).</small>
                </div>
                <!-- Text: Prodi -->
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">Program Studi - Posisi Y <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" name="y_prodi" class="form-control" value="{{ old('y_prodi', is_array($config) ? ($config['y_prodi'] ?? 100) : 100) }}" required>
                    <small class="form-text text-muted">Jarak vertikal Prodi dari atas (default: 100).</small>
                </div>
                <!-- Text: Ukuran Font NIM & Prodi -->
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">Ukuran Font NIM & Prodi <span class="text-danger">*</span></label>
                    <input type="number" step="1" name="font_size_nim_prodi" class="form-control" value="{{ old('font_size_nim_prodi', is_array($config) ? ($config['font_size_nim_prodi'] ?? 18) : 18) }}" required>
                    <small class="form-text text-muted">Ukuran teks NIM dan Prodi dalam pt (default: 18).</small>
                </div>
            </div>

            <div class="form-group text-right mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan Template
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
