@extends('backend.template.modern')
@section('title', 'Template Sertifikat')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="font-headline font-bold text-2xl text-on-surface">Template Sertifikat</h2>
            <p class="text-outline">Kelola gambar background dan pengaturan posisi teks (X/Y) sertifikat.</p>
        </div>
        <a href="{{ route('admin.sertifikat.templates.create') }}" class="btn btn-primary d-flex align-items-center gap-2 rounded-xl px-4">
            <span class="material-symbols-outlined">add</span> Tambah Template
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card bg-surface-container-lowest border-0 shadow-sm rounded-2xl p-4">
            <table class="stitch-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Template</th>
                        <th>Background</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($templates as $index => $template)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-bold text-on-surface">{{ $template->name }}</td>
                        <td>
                            @if($template->background)
                                <span class="badge bg-success rounded-pill px-3 py-2">Terunggah</span>
                            @else
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Kosong</span>
                            @endif
                        </td>
                        <td>
                            @if($template->status)
                                <span class="badge bg-success rounded-pill px-3 py-2">Aktif</span>
                            @else
                                <span class="badge bg-danger rounded-pill px-3 py-2">Nonaktif</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('admin.sertifikat.templates.edit', $template->id) }}" class="btn btn-sm btn-outline-primary rounded-lg d-flex align-items-center gap-1">
                                <span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Edit
                            </a>
                            <form action="{{ route('admin.sertifikat.templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus template ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-lg d-flex align-items-center gap-1">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">delete</span> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-outline">Belum ada template.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
