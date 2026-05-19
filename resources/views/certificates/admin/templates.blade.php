@extends('backend.layout-admin')
@section('title', 'Template Sertifikat')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Template Sertifikat</h4>
            <span class="text-muted">Kelola gambar background dan pengaturan posisi teks (X/Y) sertifikat.</span>
        </div>
        <a href="{{ route('admin.sertifikat.templates.create') }}" class="btn btn-primary btn-round">
            <i class="fas fa-plus mr-2"></i> Tambah Template
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Template</th>
                                    <th scope="col">Background</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $index => $template)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $template->name }}</strong></td>
                                    <td>
                                        @if($template->background)
                                            <span class="badge badge-success">Terunggah</span>
                                        @else
                                            <span class="badge badge-warning text-dark">Kosong</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($template->status)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.sertifikat.templates.edit', $template->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.sertifikat.templates.destroy', $template->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus template ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada template.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
