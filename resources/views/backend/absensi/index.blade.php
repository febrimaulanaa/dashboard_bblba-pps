@extends('backend.template.modern')

@section('title', 'Data Monitoring Pemantauan TTM/TUWEB')

@section('content')
<div class="bg-surface-container-lowest rounded-2xl shadow-[0_12px_32px_rgba(24,28,32,0.04)] border border-outline-variant/10 overflow-hidden">
    <!-- Clean Header with Export Button -->
    <div class="p-6 flex flex-col md:flex-row justify-between items-center gap-4 bg-white border-b border-outline-variant/10">
        <h4 class="text-lg font-bold text-on-surface m-0 font-headline">Daftar Hasil Pemantauan Semester 2025 Genap</h4>
        <a href="{{ route('admin.absensi.export') }}" class="flex items-center gap-2 px-6 py-2.5 bg-[#006191] text-white rounded-xl text-sm font-bold shadow-md hover:opacity-90 transition-all">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
    </div>
    
    <!-- Table Content Area -->
    <div class="p-6 bg-white">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table">
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
