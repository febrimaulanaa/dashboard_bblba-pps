<div class="data-card">
    <div class="data-card-header">
        <h3>Data Workshop Tugas & KU</h3>
        <div>
            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah</a>
            <a href="{{ route('exportwtku') }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Export</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Masa</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach(\App\Models\DataSertifWTKU::paginate(20) as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->masa }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->nim }}</td>
                    <td>{{ $row->prodi }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding: 15px;">
            <p>Total: {{ \App\Models\DataSertifWTKU::count() }} data</p>
        </div>
    </div>
</div>