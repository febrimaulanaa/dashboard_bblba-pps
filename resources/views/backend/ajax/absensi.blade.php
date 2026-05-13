<div class="data-card">
    <div class="data-card-header">
        <h3>Data Absensi Pegawai (Monitoring)</h3>
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
                </tr>
            </thead>
            <tbody>
                @php
                try {
                    $absensis = \App\Models\AbsensiPegawai::latest()->limit(20)->get();
                    $total = \App\Models\AbsensiPegawai::count();
                } catch (\Exception $e) {
                    $absensis = [];
                    $total = 0;
                }
                $no = 1;
                @endphp
                @forelse($absensis as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nama_pemantau ?? '-' }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->jenis_tutorial ?? '-' }}</td>
                    <td>{{ $row->kode_nama_matkul_kelas ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Belum ada data absensi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding: 15px;">
            <p>Total: {{ $total }} record</p>
        </div>
    </div>
</div>