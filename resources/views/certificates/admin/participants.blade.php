@extends('backend.template.modern')
@section('title', 'Data Peserta Sertifikat')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="font-headline font-bold text-2xl text-on-surface">Data Peserta Sertifikat</h2>
            <p class="text-outline">Daftar peserta yang telah mendaftar dan mendapatkan sertifikat.</p>
        </div>
        <div>
            <button class="btn btn-primary rounded-xl font-bold shadow-sm d-flex align-items-center gap-2" data-toggle="modal" data-target="#addParticipantModal">
                <span class="material-symbols-outlined" style="font-size: 20px;">add</span> Tambah Peserta
            </button>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <form method="GET" action="{{ route('admin.sertifikat.participants') }}" class="d-flex gap-2 align-items-center">
            <select name="event_id" class="form-select rounded-lg border-outline-variant/40" onchange="this.form.submit()" style="max-width: 300px;">
                <option value="">-- Semua Kegiatan --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                        {{ $event->name }}
                    </option>
                @endforeach
            </select>
            <button type="button" class="btn btn-outline-primary rounded-lg d-flex align-items-center gap-1" onclick="alert('Fitur Export Excel belum diimplementasikan di tutorial ini')">
                <span class="material-symbols-outlined" style="font-size: 18px;">download</span> Export Excel
            </button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card bg-surface-container-lowest border-0 shadow-sm rounded-2xl p-4">
            <table class="stitch-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Sertifikat</th>
                        <th>Nama Peserta</th>
                        <th>NIM / Email</th>
                        <th>Kegiatan</th>
                        <th>Status Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $index => $participant)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-bold text-on-surface" style="font-size: 12px;">{{ $participant->certificate_number ?? '-' }}</td>
                        <td class="font-bold text-on-surface">{{ $participant->name }}</td>
                        <td>
                            <div>{{ $participant->nim }}</div>
                            <div class="text-outline" style="font-size: 12px;">{{ $participant->email }}</div>
                        </td>
                        <td>{{ $participant->event->name }}</td>
                        <td>
                            @if($participant->email_sent)
                                <span class="badge bg-success rounded-pill px-3 py-2">Terkirim</span>
                            @else
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Belum/Gagal</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <form action="{{ route('admin.sertifikat.participants.resend', $participant->id) }}" method="POST" class="d-inline m-0 p-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary rounded-lg d-flex align-items-center justify-content-center" title="Resend Email" onclick="return confirm('Apakah Anda yakin ingin mengirim ulang sertifikat ke {{ $participant->email }}?')">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">send</span>
                                    </button>
                                </form>
                                @if($participant->certificate_path)
                                <a href="{{ Storage::url($participant->certificate_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-lg d-flex align-items-center justify-content-center" title="Download PDF">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">picture_as_pdf</span>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-outline">Belum ada data peserta.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Tambah Peserta -->
<div class="modal fade" id="addParticipantModal" tabindex="-1" role="dialog" aria-labelledby="addParticipantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-sm rounded-2xl">
            <form action="{{ route('admin.sertifikat.participants.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold text-on-surface" id="addParticipantModalLabel">Tambah Peserta Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: transparent; border: none; font-size: 1.5rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-3">
                    <div class="form-group mb-3">
                        <label class="form-label font-bold text-on-surface">Kegiatan <span class="text-danger">*</span></label>
                        <select name="event_id" class="form-control rounded-lg" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label font-bold text-on-surface">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-lg" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label font-bold text-on-surface">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control rounded-lg" required placeholder="Email untuk pengiriman sertifikat">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label font-bold text-on-surface">NIM (Opsional)</label>
                        <input type="text" name="nim" class="form-control rounded-lg" placeholder="Nomor Induk Mahasiswa">
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label font-bold text-on-surface">Prodi (Opsional)</label>
                            <input type="text" name="prodi" class="form-control rounded-lg" placeholder="Program Studi">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label font-bold text-on-surface">Fakultas (Opsional)</label>
                            <input type="text" name="fakultas" class="form-control rounded-lg" placeholder="Fakultas">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-lg" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-lg font-bold">Simpan & Proses PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
