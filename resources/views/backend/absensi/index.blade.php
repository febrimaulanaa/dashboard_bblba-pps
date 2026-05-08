@extends('backend.template.master')

@section('title', 'Data Monitoring Pemantauan TTM/TUWEB')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Monitoring Pemantauan TTM/TUWEB</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('home') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Absensi Pegawai</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Daftar Hasil Pemantauan Semester 2025 Genap</h4>
                            <div>
                                <a href="{{ route('admin.absensi.export') }}" class="btn btn-success btn-sm btn-round">
                                    <i class="fas fa-file-excel mr-2"></i> Export Excel
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Waktu Submit</th>
                                            <th>Nama Pemantau</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Nama Tutor</th>
                                            <th>Kelas</th>
                                            <th>Lokasi GPS</th>
                                            <th class="text-center">Lampiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensis as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                                <td>{{ $item->nama_pemantau }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td><span class="badge badge-info">{{ $item->jenis_tutorial }}</span></td>
                                                <td>{{ $item->nama_tutor }}</td>
                                                <td>{{ $item->kode_nama_matkul_kelas }}</td>
                                                <td>
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $item->latitude }},{{ $item->longitude }}"
                                                        target="_blank" class="btn btn-primary btn-sm btn-link"
                                                        data-toggle="tooltip" title="Lihat Lokasi GPS">
                                                        <i class="fas fa-map-marker-alt"></i> Peta
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-toggle="modal" data-target="#fotoModal{{ $item->id }}">
                                                        <i class="fas fa-images mr-1"></i> Lihat Foto
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Foto -->
                                            <div class="modal fade" id="fotoModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Lampiran Foto (Tutor: {{ $item->nama_tutor }})</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-4">
                                                                    <h6 class="font-weight-bold mb-3">Screenshot/Foto Materi</h6>
                                                                    @if ($item->file_materi)
                                                                        <img src="{{ Str::startsWith($item->file_materi, 'http') ? $item->file_materi : asset($item->file_materi) }}" class="img-fluid rounded shadow-sm" alt="Foto Materi">
                                                                        <div class="mt-2">
                                                                            <a href="{{ Str::startsWith($item->file_materi, 'http') ? $item->file_materi : asset($item->file_materi) }}" target="_blank" class="btn btn-primary btn-sm mt-2">Buka Resolusi Penuh</a>
                                                                        </div>
                                                                    @else
                                                                        <p class="text-muted">Tidak ada foto</p>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <h6 class="font-weight-bold mb-3">Screenshot/Foto Peserta</h6>
                                                                    @if ($item->file_peserta)
                                                                        <img src="{{ Str::startsWith($item->file_peserta, 'http') ? $item->file_peserta : asset($item->file_peserta) }}" class="img-fluid rounded shadow-sm" alt="Foto Peserta">
                                                                        <div class="mt-2">
                                                                            <a href="{{ Str::startsWith($item->file_peserta, 'http') ? $item->file_peserta : asset($item->file_peserta) }}" target="_blank" class="btn btn-primary btn-sm mt-2">Buka Resolusi Penuh</a>
                                                                        </div>
                                                                    @else
                                                                        <p class="text-muted">Tidak ada foto</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <hr>
                                                                    <h6 class="font-weight-bold mb-3">Cuplikan Video Rekaman</h6>
                                                                    <a href="{{ $item->link_video }}" target="_blank" class="btn btn-danger btn-block">
                                                                        <i class="fas fa-video mr-1"></i> Buka Link Video
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 10
        });
        
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
