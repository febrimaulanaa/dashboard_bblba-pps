@extends('backend.layout-admin')
@section('title', 'Data Peserta Sertifikat')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-1">Data Peserta Sertifikat</h4>
            <span class="text-muted">Daftar peserta yang telah mendaftar dan mendapatkan sertifikat.</span>
        </div>
        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#addParticipantModal">
            <i class="fas fa-plus mr-2"></i> Tambah Peserta
        </button>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="{{ route('admin.sertifikat.participants') }}" class="form-inline">
                <div class="form-group mb-2 mr-2">
                    <select name="event_id" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Semua Kegiatan --</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="btn btn-outline-primary mb-2" onclick="alert('Fitur Export Excel belum diimplementasikan di tutorial ini')">
                    <i class="fas fa-file-excel mr-1"></i> Export Excel
                </button>
            </form>
        </div>
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
                                    <th scope="col">Nomor Sertifikat</th>
                                    <th scope="col">Nama Peserta</th>
                                    <th scope="col">NIM / Email</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Status Email</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($participants as $index => $participant)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><small><strong>{{ $participant->certificate_number ?? '-' }}</strong></small></td>
                                    <td><strong>{{ $participant->name }}</strong></td>
                                    <td>
                                        <div>{{ $participant->nim }}</div>
                                        <div class="text-muted"><small>{{ $participant->email }}</small></div>
                                    </td>
                                    <td>{{ $participant->event->name }}</td>
                                    <td>
                                        @if($participant->email_sent)
                                            <span class="badge badge-success">Terkirim</span>
                                        @else
                                            <span class="badge badge-warning text-dark">Belum/Gagal</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('admin.sertifikat.participants.resend', $participant->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary" title="Resend Email" onclick="return confirm('Apakah Anda yakin ingin mengirim ulang sertifikat ke {{ $participant->email }}?')">
                                                    <i class="fas fa-paper-plane"></i>
                                                </button>
                                            </form>
                                            @if($participant->certificate_path)
                                            <a href="{{ Storage::url($participant->certificate_path) }}" target="_blank" class="btn btn-sm btn-secondary" title="Download PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada data peserta.</td>
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

<!-- Modal Tambah Peserta -->
<div class="modal fade" id="addParticipantModal" tabindex="-1" role="dialog" aria-labelledby="addParticipantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.sertifikat.participants.store') }}" method="POST" id="participantForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addParticipantModalLabel">Tambah Peserta Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kegiatan <span class="text-danger">*</span></label>
                        <select name="event_id" class="form-control" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required placeholder="Email untuk pengiriman sertifikat">
                    </div>
                    <div class="form-group">
                        <label>NIM (Opsional)</label>
                        <input type="text" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prodi (Opsional)</label>
                                <input type="text" name="prodi" class="form-control" placeholder="Program Studi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fakultas (Opsional)</label>
                                <input type="text" name="fakultas" class="form-control" placeholder="Fakultas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan & Proses PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('participantForm').addEventListener('submit', function(e) {
        if (this.dataset.encoded) return true;
        e.preventDefault();
        
        // Add hidden input to tell controller that data is encoded
        const encodedInput = document.createElement('input');
        encodedInput.type = 'hidden';
        encodedInput.name = 'is_encoded';
        encodedInput.value = '1';
        this.appendChild(encodedInput);
        
        // Encode these fields to bypass WAF
        const fieldsToEncode = ['name', 'email', 'nim', 'prodi', 'fakultas'];
        fieldsToEncode.forEach(function(fieldName) {
            const input = document.querySelector('#participantForm input[name="' + fieldName + '"]');
            if (input && input.value) {
                // Encode using btoa (Base64), with encodeURIComponent to handle UTF-8 chars
                const encodedValue = btoa(unescape(encodeURIComponent(input.value)));
                
                // Create a hidden input for the encoded value
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = fieldName;
                hiddenInput.value = encodedValue;
                document.getElementById('participantForm').appendChild(hiddenInput);
                
                // Remove name from original input so it doesn't get submitted as plain text
                input.removeAttribute('name');
            }
        });
        
        this.dataset.encoded = 'true';
        this.submit();
    });
</script>
@endsection
