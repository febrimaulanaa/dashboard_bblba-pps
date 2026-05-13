<div class="data-card">
    <div class="data-card-header">
        <h3>Manajemen Pegawai</h3>
        <div>
            <a href="#" class="btn btn-success btn-sm" onclick="openModal('tambah-user')"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach(\App\Models\User::paginate(20) as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding: 15px;">
            <p>Total: {{ \App\Models\User::count() }} user</p>
        </div>
    </div>
</div>