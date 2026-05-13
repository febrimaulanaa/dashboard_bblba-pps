<div class="data-card">
    <div class="data-card-header">
        <h3>Jadwal TTM & Tuweb</h3>
        <div>
            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah</a>
            <a href="{{ route('exporttuweb') }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Export</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nama Tutor</th>
                    <th>Kode MK</th>
                    <th>Nama MK</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach(\App\Models\JadwalTuweb::paginate(20) as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nim }}</td>
                    <td>{{ $row->nama_mhs }}</td>
                    <td>{{ $row->nama_tutor }}</td>
                    <td>{{ $row->kode_matkul }}</td>
                    <td>{{ $row->nama_matkul }}</td>
                    <td>{{ $row->hari }}</td>
                    <td>{{ $row->jam }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding: 15px;">
            <p>Total: {{ \App\Models\JadwalTuweb::count() }} data</p>
        </div>
    </div>
</div>