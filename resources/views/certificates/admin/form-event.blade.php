@extends('backend.layout-admin')
@section('title', isset($event) ? 'Edit Kegiatan' : 'Tambah Kegiatan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1 text-dark">
            {{ isset($event) ? 'Edit Kegiatan' : 'Tambah Kegiatan Baru' }}
        </h3>
        <p class="text-muted mb-0">Kelola data kegiatan dan tautan pendaftaran sertifikat otomatis.</p>
    </div>
    <a href="{{ route('admin.sertifikat.events') }}" class="btn btn-outline-secondary">
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

        <form action="{{ isset($event) ? route('admin.sertifikat.events.update', $event->id) : route('admin.sertifikat.events.store') }}" method="POST">
            @csrf
            @if(isset($event))
                @method('PUT')
            @endif

            <div class="form-group">
                <label class="font-weight-bold">Nama Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $event->name ?? '') }}" required placeholder="Contoh: Orientasi Mahasiswa Baru 2026">
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Slug (Opsional)</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $event->slug ?? '') }}" placeholder="Akan otomatis dibuat jika dikosongkan. Contoh: osmb-2026">
                <small class="form-text text-muted">ID Kegiatan (otomatis) akan digunakan sebagai URL publik: <code>/ecertificate?id=[ID_KEGIATAN]</code></small>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Tanggal Kegiatan <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', isset($event) && $event->start_date ? $event->start_date->format('Y-m-d') : '') }}" required>
                </div>

                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">Template Sertifikat</label>
                    <select name="template_id" class="form-control">
                        <option value="">-- Pilih Template (Bisa menyusul) --</option>
                        @foreach($templates as $template)
                            <option value="{{ $template->id }}" {{ old('template_id', $event->template_id ?? '') == $template->id ? 'selected' : '' }}>
                                {{ $template->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Deskripsi (Opsional)</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Penjelasan singkat tentang acara ini...">{{ old('description', $event->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="status" id="status" {{ (old('status', $event->status ?? 1)) ? 'checked' : '' }} value="1">
                    <label class="custom-control-label font-weight-bold" for="status">Form Pendaftaran Aktif (Dibuka)</label>
                </div>
            </div>

            <div class="form-group text-right mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan Kegiatan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
