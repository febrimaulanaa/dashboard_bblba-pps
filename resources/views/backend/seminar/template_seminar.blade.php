@extends('backend.layout-admin')
@section('title', 'Template Sertifikat Seminar')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="card-title mb-0">Modifikasi Template Sertifikat Seminar</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Upload Template PDF</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.seminar.template.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="template_pdf">File Template (PDF)</label>
                                <input type="file" class="form-control-file" id="template_pdf" name="template_pdf" accept="application/pdf" required>
                                <small class="form-text text-muted">File akan disimpan sebagai sertifikatseminar.pdf.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Ganti Template</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Pengaturan Posisi & Ukuran Teks</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.seminar.template.config') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Posisi Y Nama</label>
                                <div class="col-sm-6">
                                    <input type="number" step="0.1" class="form-control" name="y_nama" value="{{ $config['y_nama'] ?? 78 }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Ukuran Font Nama</label>
                                <div class="col-sm-6">
                                    <input type="number" step="1" class="form-control" name="font_size_nama" value="{{ $config['font_size_nama'] ?? 25 }}">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Posisi Y NIM</label>
                                <div class="col-sm-6">
                                    <input type="number" step="0.1" class="form-control" name="y_nim" value="{{ $config['y_nim'] ?? 92 }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Posisi Y Program Studi</label>
                                <div class="col-sm-6">
                                    <input type="number" step="0.1" class="form-control" name="y_prodi" value="{{ $config['y_prodi'] ?? 100 }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Ukuran Font NIM & Prodi</label>
                                <div class="col-sm-6">
                                    <input type="number" step="1" class="form-control" name="font_size_nim_prodi" value="{{ $config['font_size_nim_prodi'] ?? 18 }}">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
