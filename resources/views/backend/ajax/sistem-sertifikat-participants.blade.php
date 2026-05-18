<div class="data-card">
    <div class="data-card-header">
        <h3>Data Peserta</h3>
        <div>
            <a href="{{ route('admin.sertifikat.participants') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Peserta</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kode Verifikasi</th>
                    <th>Email Terkirim</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach(\App\Models\CertificateParticipant::paginate(20) as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->verification_code }}</td>
                    <td>{{ $row->email_sent ? 'Ya' : 'Belum' }}</td>
                    <td style="display: flex; gap: 5px;">
                        <form action="{{ route('admin.sertifikat.participants.resend', $row->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Kirim Ulang</button>
                        </form>
                        <form action="{{ route('admin.sertifikat.participants.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus peserta ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding: 15px;">
            <p>Total: {{ \App\Models\CertificateParticipant::count() }} peserta</p>
        </div>
    </div>
</div>