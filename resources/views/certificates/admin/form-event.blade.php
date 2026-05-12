@extends('backend.template.modern')
@section('title', isset($event) ? 'Edit Kegiatan' : 'Tambah Kegiatan')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="font-headline font-bold text-2xl text-on-surface">
                {{ isset($event) ? 'Edit Kegiatan' : 'Tambah Kegiatan Baru' }}
            </h2>
            <p class="text-outline">Kelola data kegiatan dan tautan pendaftaran sertifikat otomatis.</p>
        </div>
        <a href="{{ route('admin.sertifikat.events') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 rounded-xl px-4">
            <span class="material-symbols-outlined">arrow_back</span> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-8">
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

            <form action="{{ isset($event) ? route('admin.sertifikat.events.update', $event->id) : route('admin.sertifikat.events.store') }}" method="POST">
                @csrf
                @if(isset($event))
                    @method('PUT')
                @endif

                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label font-bold text-on-surface">Nama Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-lg p-3" value="{{ old('name', $event->name ?? '') }}" required placeholder="Contoh: Orientasi Mahasiswa Baru 2026">
                    </div>

                    <div class="col-12">
                        <label class="form-label font-bold text-on-surface">Slug (Opsional)</label>
                        <input type="text" name="slug" class="form-control rounded-lg p-3" value="{{ old('slug', $event->slug ?? '') }}" placeholder="Akan otomatis dibuat jika dikosongkan. Contoh: osmb-2026">
                        <small class="text-outline">Slug akan digunakan sebagai URL publik pendaftaran: <code>/sertifikat-form/slug-kegiatan</code></small>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label font-bold text-on-surface">Tanggal Kegiatan <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control rounded-lg p-3" value="{{ old('date', isset($event) ? $event->date->format('Y-m-d') : '') }}" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label font-bold text-on-surface">Template Sertifikat</label>
                        <select name="template_id" class="form-select rounded-lg p-3">
                            <option value="">-- Pilih Template (Bisa menyusul) --</option>
                            @foreach($templates as $template)
                                <option value="{{ $template->id }}" {{ old('template_id', $event->template_id ?? '') == $template->id ? 'selected' : '' }}>
                                    {{ $template->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label font-bold text-on-surface">Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control rounded-lg p-3" rows="4" placeholder="Penjelasan singkat tentang acara ini...">{{ old('description', $event->description ?? '') }}</textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="status" id="status" {{ (old('status', $event->status ?? 1)) ? 'checked' : '' }} value="1" style="transform: scale(1.2); margin-top: 6px;">
                            <label class="form-check-label font-bold text-on-surface ms-2" for="status">
                                Form Pendaftaran Aktif (Dibuka)
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="submit" class="btn btn-primary rounded-xl px-5 py-2 font-bold shadow-sm">
                            <span class="material-symbols-outlined align-middle" style="font-size: 20px;">save</span> Simpan Kegiatan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
