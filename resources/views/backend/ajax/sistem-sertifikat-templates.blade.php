<div class="data-card">
    <div class="data-card-header">
        <h3>Template Sertifikat</h3>
        <div>
            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Template</a>
        </div>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Template</th>
                    <th>Event</th>
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
                    <td>{{ $row->event_id }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
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