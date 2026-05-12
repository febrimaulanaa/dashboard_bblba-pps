@extends('backend.template.modern')
@section('title', isset($template) ? 'Edit Template' : 'Tambah Template')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="font-headline font-bold text-2xl text-on-surface">
                {{ isset($template) ? 'Edit Template Sertifikat' : 'Tambah Template Sertifikat' }}
            </h2>
            <p class="text-outline">Atur gambar background dan koordinat teks pada sertifikat.</p>
        </div>
        <a href="{{ route('admin.sertifikat.templates') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 rounded-xl px-4">
            <span class="material-symbols-outlined">arrow_back</span> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-10">
        <div class="card bg-surface-container-lowest border-0 shadow-sm rounded-2xl p-4">
            
            @if ($errors->any())
                <div class="alert alert-danger rounded-xl">
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

                <div class="row g-4">
                    <!-- Basic Info -->
                    <div class="col-12 col-md-6">
                        <label class="form-label font-bold text-on-surface">Nama Template <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-lg p-3" value="{{ old('name', $template->name ?? '') }}" required placeholder="Contoh: Template OSMB 2026">
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <label class="form-label font-bold text-on-surface">Background (Image)</label>
                        <input type="file" name="background" class="form-control rounded-lg p-3" accept="image/jpeg,image/png,image/jpg">
                        <small class="text-outline d-block mt-1">Format: JPG, PNG. Ukuran rasio A4/Landscape (rekomendasi: 2000x1414px).</small>
                        @if(isset($template) && $template->background)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $template->background) }}" target="_blank" class="text-primary text-decoration-none" style="font-size: 14px;">Lihat Background Saat Ini</a>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mt-4 mb-2">
                        <h4 class="font-bold text-on-surface border-bottom pb-2">Pengaturan Koordinat Teks (X, Y)</h4>
                        <p class="text-outline" style="font-size: 14px;">Atur posisi X (kiri ke kanan) dan Y (atas ke bawah) dalam satuan piksel. Anda perlu mencoba mencetak (Preview) beberapa kali untuk mendapatkan posisi yang pas.</p>
                    </div>

                    <!-- Text: Nama Peserta -->
                    <div class="col-12 col-md-4">
                        <label class="form-label font-bold text-on-surface">Nama Peserta - Posisi X <span class="text-danger">*</span></label>
                        <input type="number" name="name_x" class="form-control rounded-lg p-3" value="{{ old('name_x', isset($template) ? ($template->settings_json['name_x'] ?? '400') : '400') }}" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label font-bold text-on-surface">Nama Peserta - Posisi Y <span class="text-danger">*</span></label>
                        <input type="number" name="name_y" class="form-control rounded-lg p-3" value="{{ old('name_y', isset($template) ? ($template->settings_json['name_y'] ?? '350') : '350') }}" required>
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="form-label font-bold text-on-surface">Ukuran Font <span class="text-danger">*</span></label>
                        <input type="number" name="name_font_size" class="form-control rounded-lg p-3" value="{{ old('name_font_size', isset($template) ? ($template->settings_json['name_font_size'] ?? '30') : '30') }}" required>
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="form-label font-bold text-on-surface">Warna Font</label>
                        <input type="color" name="name_color" class="form-control form-control-color w-100" style="height: 54px;" value="{{ old('name_color', isset($template) ? ($template->settings_json['name_color'] ?? '#000000') : '#000000') }}" title="Pilih Warna">
                    </div>

                    <!-- Text: Nomor Sertifikat -->
                    <div class="col-12 col-md-4">
                        <label class="form-label font-bold text-on-surface">Nomor Sertifikat - Posisi X <span class="text-danger">*</span></label>
                        <input type="number" name="number_x" class="form-control rounded-lg p-3" value="{{ old('number_x', isset($template) ? ($template->settings_json['number_x'] ?? '400') : '400') }}" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label font-bold text-on-surface">Nomor Sertifikat - Posisi Y <span class="text-danger">*</span></label>
                        <input type="number" name="number_y" class="form-control rounded-lg p-3" value="{{ old('number_y', isset($template) ? ($template->settings_json['number_y'] ?? '250') : '250') }}" required>
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="form-label font-bold text-on-surface">Ukuran Font <span class="text-danger">*</span></label>
                        <input type="number" name="number_font_size" class="form-control rounded-lg p-3" value="{{ old('number_font_size', isset($template) ? ($template->settings_json['number_font_size'] ?? '18') : '18') }}" required>
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="form-label font-bold text-on-surface">Warna Font</label>
                        <input type="color" name="number_color" class="form-control form-control-color w-100" style="height: 54px;" value="{{ old('number_color', isset($template) ? ($template->settings_json['number_color'] ?? '#000000') : '#000000') }}" title="Pilih Warna">
                    </div>

                    <!-- QRCode -->
                    <div class="col-12 col-md-4">
                        <label class="form-label font-bold text-on-surface">QR Code - Posisi X <span class="text-danger">*</span></label>
                        <input type="number" name="qrcode_x" class="form-control rounded-lg p-3" value="{{ old('qrcode_x', isset($template) ? ($template->settings_json['qrcode_x'] ?? '100') : '100') }}" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label font-bold text-on-surface">QR Code - Posisi Y <span class="text-danger">*</span></label>
                        <input type="number" name="qrcode_y" class="form-control rounded-lg p-3" value="{{ old('qrcode_y', isset($template) ? ($template->settings_json['qrcode_y'] ?? '500') : '500') }}" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label font-bold text-on-surface">Ukuran QR Code <span class="text-danger">*</span></label>
                        <input type="number" name="qrcode_size" class="form-control rounded-lg p-3" value="{{ old('qrcode_size', isset($template) ? ($template->settings_json['qrcode_size'] ?? '100') : '100') }}" required>
                    </div>

                    <div class="col-12">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="status" id="status" {{ (old('status', $template->status ?? 1)) ? 'checked' : '' }} value="1" style="transform: scale(1.2); margin-top: 6px;">
                            <label class="form-check-label font-bold text-on-surface ms-2" for="status">
                                Template Aktif
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="submit" class="btn btn-primary rounded-xl px-5 py-2 font-bold shadow-sm">
                            <span class="material-symbols-outlined align-middle" style="font-size: 20px;">save</span> Simpan Template
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
