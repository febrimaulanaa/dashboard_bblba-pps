@extends('backend.layout-admin')
@section('title', 'Manajemen Akun Admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="card-title mb-0">Manajemen Akun Admin</h4>
    </div>
    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-primary my-3" data-toggle="modal" data-target="#addAdminModal">
                TAMBAH ADMIN
            </button>
        </div>

        <!-- Add Admin Modal -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{ route('admin.admins.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Admin Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required placeholder="Masukkan nama">
                            </div>
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" required placeholder="Masukkan username">
                            </div>
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" required placeholder="Minimal 6 karakter">
                            </div>
                            <div class="form-group">
                                <label>Role <span class="text-danger">*</span></label>
                                <select class="form-control" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">Superadmin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table id="adminTable" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Tanggal Dibuat</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $index => $admin)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>
                                @if($admin->role == 'superadmin')
                                    <span class="badge badge-primary">Superadmin</span>
                                @else
                                    <span class="badge badge-info">Admin</span>
                                @endif
                            </td>
                            <td>{{ $admin->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editAdminModal{{ $admin->id }}">Edit</button>
                                @if(session('admin_id') != $admin->id)
                                <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                                @endif
                            </td>
                        </tr>

                        <!-- Edit Admin Modal -->
                        <div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{ route('admin.admins.update', $admin->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Admin</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ $admin->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" value="{{ $admin->username }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password (Kosongkan jika tidak diubah)</label>
                                                <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter">
                                            </div>
                                            <div class="form-group">
                                                <label>Role <span class="text-danger">*</span></label>
                                                <select class="form-control" name="role" required>
                                                    <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="superadmin" {{ $admin->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#adminTable').DataTable();
    });
</script>
@endsection
