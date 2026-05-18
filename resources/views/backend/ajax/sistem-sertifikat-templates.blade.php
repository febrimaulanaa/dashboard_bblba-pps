<div class="data-card">
    <div class="data-card-header">
        <h3>Template Sertifikat</h3>
        <div>
            <a href="{{ route('admin.sertifikat.templates.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Template</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Template</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach(\App\Models\CertificateTemplate::paginate(20) as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->status ? 'Aktif' : 'Nonaktif' }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td style="display: flex; gap: 5px;">
                        <a href="{{ route('admin.sertifikat.templates.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.sertifikat.templates.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
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
            <p>Total: {{ \App\Models\CertificateTemplate::count() }} template</p>
        </div>
    </div>
</div>