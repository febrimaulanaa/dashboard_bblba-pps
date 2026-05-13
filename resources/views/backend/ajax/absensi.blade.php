<div class="data-card">
    <div class="data-card-header">
        <h3>Data Absensi Pegawai</h3>
        <div>
            <a href="{{ route('admin.absensi.export') }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Export</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach(\App\Models\AbsensiPegawai::paginate(20) as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nama ?? '-' }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->jam_masuk ?? '-' }}</td>
                    <td>{{ $row->jam_keluar ?? '-' }}</td>
                    <td>{{ $row->status ?? 'Hadir' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding: 15px;">
            <p>Total: {{ \App\Models\AbsensiPegawai::count() }} record</p>
        </div>
    </div>
</div>