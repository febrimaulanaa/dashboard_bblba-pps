<div class="data-card">
    <div class="data-card-header">
        <h3>Data Peserta</h3>
        <div>
            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Peserta</a>
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
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Kirim Ulang</a>
                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
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