@extends('backend.layout-admin')
@section('title', 'Data Kegiatan Sertifikat')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Data Kegiatan</h4>
            <span class="text-muted">Daftar kegiatan untuk pendaftaran dan sertifikat</span>
        </div>
        <a href="{{ route('admin.sertifikat.events.create') }}" class="btn btn-primary btn-round">
            <i class="fas fa-plus mr-2"></i> Tambah Kegiatan
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
                                    <th scope="col">Nama Kegiatan</th>
                                    <th scope="col">URL Pendaftaran</th>
                                    <th scope="col">Template</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $index => $event)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $event->name }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ url('/ecertificate/' . $event->id) }}" target="_blank" class="text-primary mr-2">
                                                <i class="fas fa-link mr-1"></i> /ecertificate/{{ $event->id }}
                                            </a>
                                            <button type="button" class="btn btn-icon btn-round btn-sm btn-light border" onclick="copyLink('{{ $event->id }}')" title="Copy URL">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{ $event->template ? $event->template->name : '-' }}</td>
                                    <td>
                                        @if($event->status)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.sertifikat.participants', ['event_id' => $event->id]) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-users"></i> Peserta
                                            </a>
                                            <a href="{{ route('admin.sertifikat.events.edit', $event->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.sertifikat.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Menghapus kegiatan juga akan menghapus seluruh data peserta di dalamnya. Yakin?');">
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
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data kegiatan.</td>
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

@push('scripts')
<script>
    function copyLink(id) {
        var dummy = document.createElement('input'),
            text = window.location.origin + '/ecertificate/' + id;
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
        
        swal("Berhasil!", "URL berhasil disalin: " + text, "success");
    }
</script>
@endpush
