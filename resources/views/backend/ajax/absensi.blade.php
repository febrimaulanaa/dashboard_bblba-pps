<div class="data-card">
    <div class="data-card-header">
        <h3>Data Absensi Pegawai (Monitoring)</h3>
        <div>
            <a href="{{ route('admin.absensi.export') }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Export</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemantau</th>
                    <th>Tanggal</th>
                    <th>Jenis Tutorial</th>
                    <th>Matkul</th>
                    <th>Jam Tutorial</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse(\App\Models\AbsensiPegawai::latest()->limit(20)->get() as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nama_pemantau ?? '-' }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->jenis_tutorial ?? '-' }}</td>
                    <td>{{ $row->kode_nama_matkul_kelas ?? '-' }}</td>
                    <td>{{ $row->jam_tutorial ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada data absensi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding: 15px;">
            <p>Total: {{ \App\Models\AbsensiPegawai::count() }} record</p>
        </div>
    </div>
</div>