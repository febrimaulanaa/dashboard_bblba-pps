@extends('backend.layout-admin')
@section('title', isset($template) ? 'Edit Template' : 'Tambah Template')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-dark">
            {{ isset($template) ? 'Edit Template Sertifikat' : 'Tambah Template Sertifikat' }}
        </h3>
        <p class="text-muted mb-0">Atur gambar background dan koordinat teks pada sertifikat.</p>
    </div>
    <a href="{{ route('admin.sertifikat.templates') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($template) ? route('admin.sertifikat.templates.update', $template->id) : route('admin.sertifikat.templates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($template))
                @method('PUT')
            @endif

            <div class="row">
                <!-- Basic Info -->
                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Nama Template <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $template->name ?? '') }}" required placeholder="Contoh: Template OSMB 2026">
                </div>
                
                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Background (Image)</label>
                    <input type="file" name="background" class="form-control-file" accept="image/jpeg,image/png,image/jpg">
                    <small class="form-text text-muted mt-1">Format: JPG, PNG. Ukuran rasio A4/Landscape (rekomendasi: 2000x1414px).</small>
                    @if(isset($template) && $template->background)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $template->background) }}" target="_blank" class="text-primary" style="font-size: 14px;">Lihat Background Saat Ini</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 mb-3 border-bottom pb-2">
                <h4 class="font-weight-bold text-dark mb-1">Pengaturan Koordinat Teks (X, Y)</h4>
                <p class="text-muted mb-0" style="font-size: 14px;">Atur posisi X (kiri ke kanan) dan Y (atas ke bawah) dalam satuan piksel. Anda perlu mencoba mencetak (Preview) beberapa kali untuk mendapatkan posisi yang pas.</p>
            </div>

            <div class="row">
                <!-- Text: Nama Peserta -->
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">Nama Peserta - Posisi X <span class="text-danger">*</span></label>
                    <input type="number" name="name_x" class="form-control" value="{{ old('name_x', isset($template) ? ($template->settings_json['name_x'] ?? '400') : '400') }}" required>
                </div>
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">Nama Peserta - Posisi Y <span class="text-danger">*</span></label>
                    <input type="number" name="name_y" class="form-control" value="{{ old('name_y', isset($template) ? ($template->settings_json['name_y'] ?? '350') : '350') }}" required>
                </div>
                <div class="col-md-2 form-group">
                    <label class="font-weight-bold">Ukuran Font <span class="text-danger">*</span></label>
                    <input type="number" name="name_font_size" class="form-control" value="{{ old('name_font_size', isset($template) ? ($template->settings_json['name_font_size'] ?? '30') : '30') }}" required>
                </div>
                <div class="col-md-2 form-group">
                    <label class="font-weight-bold">Warna Font</label>
                    <input type="color" name="name_color" class="form-control form-control-color w-100" style="height: 38px;" value="{{ old('name_color', isset($template) ? ($template->settings_json['name_color'] ?? '#000000') : '#000000') }}" title="Pilih Warna">
                </div>
            </div>

            <div class="row" style="display: none;">
                <!-- Text: Nomor Sertifikat (Hidden since user requested to remove it earlier) -->
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">Nomor Sertifikat - Posisi X <span class="text-danger">*</span></label>
                    <input type="number" name="number_x" class="form-control" value="{{ old('number_x', isset($template) ? ($template->settings_json['number_x'] ?? '400') : '400') }}">
                </div>
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">Nomor Sertifikat - Posisi Y <span class="text-danger">*</span></label>
                    <input type="number" name="number_y" class="form-control" value="{{ old('number_y', isset($template) ? ($template->settings_json['number_y'] ?? '250') : '250') }}">
                </div>
                <div class="col-md-2 form-group">
                    <label class="font-weight-bold">Ukuran Font <span class="text-danger">*</span></label>
                    <input type="number" name="number_font_size" class="form-control" value="{{ old('number_font_size', isset($template) ? ($template->settings_json['number_font_size'] ?? '18') : '18') }}">
                </div>
                <div class="col-md-2 form-group">
                    <label class="font-weight-bold">Warna Font</label>
                    <input type="color" name="number_color" class="form-control form-control-color w-100" style="height: 38px;" value="{{ old('number_color', isset($template) ? ($template->settings_json['number_color'] ?? '#000000') : '#000000') }}" title="Pilih Warna">
                </div>
            </div>

            <div class="row" style="display: none;">
                <!-- QRCode (Hidden since user requested to remove it earlier) -->
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">QR Code - Posisi X <span class="text-danger">*</span></label>
                    <input type="number" name="qrcode_x" class="form-control" value="{{ old('qrcode_x', isset($template) ? ($template->settings_json['qrcode_x'] ?? '100') : '100') }}">
                </div>
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">QR Code - Posisi Y <span class="text-danger">*</span></label>
                    <input type="number" name="qrcode_y" class="form-control" value="{{ old('qrcode_y', isset($template) ? ($template->settings_json['qrcode_y'] ?? '500') : '500') }}">
                </div>
                <div class="col-md-4 form-group">
                    <label class="font-weight-bold">Ukuran QR Code <span class="text-danger">*</span></label>
                    <input type="number" name="qrcode_size" class="form-control" value="{{ old('qrcode_size', isset($template) ? ($template->settings_json['qrcode_size'] ?? '100') : '100') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch mt-3">
                    <input type="checkbox" class="custom-control-input" name="status" id="status" {{ (old('status', $template->status ?? 1)) ? 'checked' : '' }} value="1">
                    <label class="custom-control-label font-weight-bold" for="status">Template Aktif</label>
                </div>
            </div>

            <div class="form-group text-right mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan Template
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
