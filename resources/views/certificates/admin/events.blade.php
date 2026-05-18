@extends('backend.template.modern')
@section('title', 'Data Kegiatan Sertifikat')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="font-headline font-bold text-2xl text-on-surface">Data Kegiatan</h2>
            <p class="text-outline">Daftar kegiatan untuk pendaftaran dan sertifikat</p>
        </div>
        <a href="{{ route('admin.sertifikat.events.create') }}" class="btn btn-primary d-flex align-items-center gap-2 rounded-xl px-4">
            <span class="material-symbols-outlined">add</span> Tambah Kegiatan
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
                        <th>Nama Kegiatan</th>
                        <th>URL Pendaftaran</th>
                        <th>Template</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $index => $event)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-bold text-on-surface">{{ $event->name }}</td>
                        <td>
                            <a href="{{ url('/ecertificate?id=' . $event->id) }}" target="_blank" class="text-primary text-decoration-none d-flex align-items-center gap-1">
                                <span class="material-symbols-outlined" style="font-size: 16px">link</span>
                                /ecertificate?id={{ $event->id }}
                            </a>
                        </td>
                        <td>{{ $event->template ? $event->template->name : '-' }}</td>
                        <td>
                            @if($event->status)
                                <span class="badge bg-success rounded-pill px-3 py-2">Aktif</span>
                            @else
                                <span class="badge bg-danger rounded-pill px-3 py-2">Nonaktif</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('admin.sertifikat.participants', ['event_id' => $event->id]) }}" class="btn btn-sm btn-outline-info rounded-lg d-flex align-items-center gap-1"><span class="material-symbols-outlined" style="font-size: 16px;">group</span> Peserta</a>
                            <a href="{{ route('admin.sertifikat.events.edit', $event->id) }}" class="btn btn-sm btn-outline-primary rounded-lg d-flex align-items-center gap-1"><span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Edit</a>
                            <form action="{{ route('admin.sertifikat.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Menghapus kegiatan juga akan menghapus seluruh data peserta di dalamnya. Yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-lg d-flex align-items-center gap-1"><span class="material-symbols-outlined" style="font-size: 16px;">delete</span></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-outline">Belum ada data kegiatan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
