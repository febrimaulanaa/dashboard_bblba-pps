<div class="data-card">
    <div class="data-card-header">
        <h3>Kelola Events</h3>
        <div>
            <a href="{{ route('admin.sertifikat.events.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Event</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach(\App\Models\CertificateEvent::paginate(20) as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->slug }}</td>
                    <td>{{ $row->start_date }}</td>
                    <td>{{ $row->end_date }}</td>
                    <td>{{ $row->status }}</td>
                    <td style="display: flex; gap: 5px;">
                        <a href="{{ route('admin.sertifikat.events.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.sertifikat.events.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
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
            <p>Total: {{ \App\Models\CertificateEvent::count() }} event</p>
        </div>
    </div>
</div>