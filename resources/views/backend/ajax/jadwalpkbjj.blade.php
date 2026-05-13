<div class="data-card">
    <div class="data-card-header">
        <h3>Jadwal PKBJJ</h3>
        <div>
            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama MK</th>
                    <th>Tutor</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach(\App\Models\JadwalPKBJJ::paginate(20) as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->kode_mk }}</td>
                    <td>{{ $row->nama_mk }}</td>
                    <td>{{ $row->tutor }}</td>
                    <td>{{ $row->hari }}</td>
                    <td>{{ $row->jam }}</td>
                    <td>{{ $row->ruang }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding: 15px;">
            <p>Total: {{ \App\Models\JadwalPKBJJ::count() }} jadwal</p>
        </div>
    </div>
</div>