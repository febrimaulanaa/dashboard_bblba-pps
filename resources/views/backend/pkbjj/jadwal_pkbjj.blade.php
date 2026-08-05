@extends('backend.layout-admin')
@section('title', 'Jadwal LPKBJJ')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="card-title mb-0">Data Peserta Kegiatan LPKBJJ</h4>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-grid gap-2 d-md-block">
            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary mr-2" id="btn-add-new" data-toggle="modal" data-target="#ajaxModel">
                        Tambah Data
                    </button>
                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#importExcel">
                        Import Excel
                    </button>
                    <a href="{{ route('exportjadwalpkbjj_excel') }}" class="btn btn-warning mr-2">
                        Export Excel
                    </a>
                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#pasteExcelModal">
                        Paste dari Excel
                    </button>
                    <button type="button" class="btn btn-secondary mr-2" id="btn-set-default-namakegiatan">
                        Set Nama Kegiatan Default
                    </button>
                    <form action="{{ route('bulkdeletejadwalpkbjj') }}" method="POST" class="d-inline" onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin menghapus SEMUA data Jadwal PKBJJ? Tindakan ini tidak dapat dibatalkan!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus Semua Data</button>
                    </form>
                </div>
            </div>

            {{-- Modal Form --}}
            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalHeading">Tambah Data Jadwal LPKBJJ</h4>
                        </div>
                        <div class="modal-body">
                            <form id="dataForm" name="dataForm" class="form-horizontal">
                                <input type="hidden" name="jadwal_id" id="jadwal_id">
                                <div class="form-group">
                                    NIM: <br>
                                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
                                </div>
                                <div class="form-group">
                                    Nama: <br>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="form-group">
                                    Nama Kegiatan: <br>
                                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Misal: LPKBJJ Tahap 1" required>
                                </div>
                                <div class="form-group">
                                    Tanggal Pelaksanaan: <br>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="Misal: 12 Agustus 2024" required>
                                </div>
                                <div class="form-group">
                                    Waktu Pelaksanaan: <br>
                                    <input type="text" class="form-control" id="waktu" name="waktu" placeholder="Misal: 08:00 - 12:00" required>
                                </div>
                                <div class="form-group">
                                    Skema: <br>
                                    <input type="text" class="form-control" id="skema" name="skema" placeholder="Misal: Tuweb" required>
                                </div>
                                <div class="form-group">
                                    Nomor Meja: <br>
                                    <input type="text" class="form-control" id="nomor_meja" name="nomor_meja" placeholder="Misal: 01" required>
                                </div>
                                <div class="form-group">
                                    No Urut Daftar Hadir: <br>
                                    <input type="text" class="form-control" id="no_urut" name="no_urut" placeholder="Misal: 12" required>
                                </div>
                                <div class="form-group">
                                    Lokasi Detail: <br>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Misal: Universitas Mercu Buana" required>
                                </div>
                                <div class="form-group">
                                    Link Google Maps: <br>
                                    <input type="text" class="form-control" id="link_lok" name="link_lok" placeholder="Masukkan Link Google Maps" required>
                                </div>
                                <div class="modal-footer">
                                    <button id="savedata" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Import Excel -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route('importjadwalpkbjj') }}" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            </div>
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <label>Pilih file excel</label>
                                <div class="form-group">
                                    <input type="file" name="file" required="required">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Bulk Paste Excel -->
            <div class="modal fade" id="pasteExcelModal" tabindex="-1" role="dialog" aria-labelledby="pasteExcelModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pasteExcelModalLabel">Paste Data dari Excel</h5>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info">
                                <strong>Cara penggunaan:</strong><br>
                                1. Buka file Excel Anda.<br>
                                2. Blok baris data Anda mulai dari NIM hingga Link Google Maps (<strong>Jangan blok nomor urut baris di sebelah kiri, dan jangan blok judul kolom di atas</strong>).<br>
                                3. Tekan Copy (Ctrl+C), lalu klik di dalam kotak di bawah ini dan tekan Paste (Ctrl+V).
                            </div>
                            <div class="form-group">
                                <label>Tempel (Paste) data di sini:</label>
                                <textarea id="pasteExcelData" class="form-control" rows="10" placeholder="Paste data excel di sini..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" id="btn-process-paste" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="example" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Waktu</th>
                        <th>Skema</th>
                        <th>Nomor Meja</th>
                        <th>No Urut</th>
                        <th>Lokasi Detail</th>
                        <th>Link Google Maps</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($jdpkbjj as $p)
                        <tr id="tr_{{ $p->id }}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->nim }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->nama_kegiatan }}</td>
                            <td>{{ $p->tanggal }}</td>
                            <td>{{ $p->waktu }}</td>
                            <td>{{ $p->skema }}</td>
                            <td>{{ $p->nomor_meja }}</td>
                            <td>{{ $p->no_urut }}</td>
                            <td>{{ $p->lokasi }}</td>
                            <td>{{ $p->link_lok }}</td>
                            <td>
                                <button data-id="{{ $p->id }}"
                                        data-nim="{{ $p->nim }}"
                                        data-nama="{{ $p->nama }}"
                                        data-nama_kegiatan="{{ $p->nama_kegiatan }}"
                                        data-tanggal="{{ $p->tanggal }}"
                                        data-waktu="{{ $p->waktu }}"
                                        data-skema="{{ $p->skema }}"
                                        data-nomor_meja="{{ $p->nomor_meja }}"
                                        data-no_urut="{{ $p->no_urut }}"
                                        data-lokasi="{{ $p->lokasi }}"
                                        data-link_lok="{{ $p->link_lok }}"
                                        class="btn btn-sm btn-info edit-btn">Edit</button>
                                <button data-id="{{ $p->id }}" class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().destroy();
        }
        $('#example').DataTable();

        $('#btn-add-new').click(function () {
            $('#dataForm').trigger("reset");
            $('#modalHeading').html("Tambah Data Jadwal LPKBJJ");
            $('#jadwal_id').val('');
        });

        $('body').on('click', '.edit-btn', function () {
            var id = $(this).data('id');
            $('#modalHeading').html("Edit Data Jadwal LPKBJJ");
            $('#jadwal_id').val(id);
            $('#nim').val($(this).data('nim'));
            $('#nama').val($(this).data('nama'));
            $('#nama_kegiatan').val($(this).data('nama_kegiatan'));
            $('#tanggal').val($(this).data('tanggal'));
            $('#waktu').val($(this).data('waktu'));
            $('#skema').val($(this).data('skema'));
            $('#nomor_meja').val($(this).data('nomor_meja'));
            $('#no_urut').val($(this).data('no_urut'));
            $('#lokasi').val($(this).data('lokasi'));
            $('#link_lok').val($(this).data('link_lok'));
            $('#ajaxModel').modal('show');
        });

        $('#dataForm').on('submit', function (e) {
            e.preventDefault();
            var id = $('#jadwal_id').val();
            var url = id ? '/pkbjj/updatejadwalpkbjj/' + id : '{{ route("storejadwalpkbjj") }}';
            
            // Siapkan data form
            var formData = $(this).serialize();
            
            // Jika ini proses edit (ada ID), gunakan trik spoofing PUT
            if (id) {
                formData += '&_method=PUT';
            }

            $.ajax({
                data: formData,
                url: url,
                type: 'POST', // Selalu gunakan POST agar tidak diblokir server
                dataType: 'json',
                success: function (data) {
                    $('#dataForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    alert('Data berhasil disimpan!');
                    location.reload();
                },
                error: function (data) {
                    alert('Error: Data gagal disimpan!');
                    console.log('Error:', data);
                }
            });
        });

        $('body').on('click', '.delete-btn', function () {
            var id = $(this).data("id");
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                $.ajax({
                    type: "POST",
                    url: '/pkbjj/deletejadwalpkbjj/' + id,
                    data: {
                        _method: 'DELETE'
                    },
                    dataType: 'json',
                    success: function (data) {
                        $("#tr_" + id).remove();
                        alert('Data berhasil dihapus!');
                    },
                    error: function (data) {
                        alert('Error: Data gagal dihapus! Pastikan Anda sudah login atau hubungi admin.');
                        console.log('Error:', data);
                    }
                });
            }
        });

        $('#btn-process-paste').click(function() {
            var rawData = $('#pasteExcelData').val();
            if (!rawData.trim()) {
                alert('Teks masih kosong, silakan paste data dari Excel terlebih dahulu!');
                return;
            }

            var rows = rawData.trim().split('\n');
            var parsedData = [];
            
            for (var i = 0; i < rows.length; i++) {
                var columns = rows[i].split('\t');
                
                // Pastikan setidaknya ada data NIM di kolom index 0 (karena kita tidak pakai 'No')
                // Jika user mencopy beserta 'No', maka kolom akan tergeser.
                // Kita asumsikan urutan: NIM, Nama, Nama Kegiatan, Tanggal, Waktu, Skema, No Meja, No Urut, Lokasi
                if (columns.length >= 2 && columns[0].trim() !== '') {
                    // Jika kolom[0] tampaknya sebuah Nomor urut (hanya angka pendek dan bukan NIM), kita skip index 0
                    var startIndex = (columns[0].length < 5) ? 1 : 0;
                    
                    parsedData.push({
                        nim: columns[startIndex] ? columns[startIndex].trim() : '',
                        nama: columns[startIndex+1] ? columns[startIndex+1].trim() : '',
                        nama_kegiatan: columns[startIndex+2] ? columns[startIndex+2].trim() : '',
                        tanggal: columns[startIndex+3] ? columns[startIndex+3].trim() : '',
                        waktu: columns[startIndex+4] ? columns[startIndex+4].trim() : '',
                        skema: columns[startIndex+5] ? columns[startIndex+5].trim() : '',
                        nomor_meja: columns[startIndex+6] ? columns[startIndex+6].trim() : '',
                        no_urut: columns[startIndex+7] ? columns[startIndex+7].trim() : '',
                        lokasi: columns[startIndex+8] ? columns[startIndex+8].trim() : '',
                        link_lok: columns[startIndex+9] ? columns[startIndex+9].trim() : ''
                    });
                }
            }

            if (parsedData.length === 0) {
                alert('Tidak ada data valid yang bisa dibaca. Pastikan format copy-paste sesuai.');
                return;
            }

            $(this).prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: '{{ route("bulkstorejadwalpkbjj") }}',
                type: 'POST',
                data: JSON.stringify({ jadwals: parsedData }),
                contentType: 'application/json',
                success: function (response) {
                    alert('Sebanyak ' + parsedData.length + ' data berhasil disimpan!');
                    location.reload();
                },
                error: function (response) {
                    $('#btn-process-paste').prop('disabled', false).text('Simpan Data');
                    alert('Terjadi kesalahan saat menyimpan data. Cek format paste Anda.');
                    console.log(response);
                }
            });
        });

        $('#btn-set-default-namakegiatan').click(function() {
            var defaultName = prompt("Masukkan 'Nama Kegiatan' yang akan diisi secara otomatis ke semua data lama yang masih kosong (contoh: LPKBJJ Tahap 1):");
            if (defaultName !== null && defaultName.trim() !== '') {
                if(confirm("Apakah Anda yakin ingin mengatur 'Nama Kegiatan' menjadi '" + defaultName + "' untuk SEMUA data yang kosong?")) {
                    $.ajax({
                        url: '{{ route("setBulkNamaKegiatan") }}',
                        type: 'POST',
                        data: { nama_kegiatan_default: defaultName.trim() },
                        success: function (response) {
                            alert(response.updated_count + ' baris data berhasil diperbarui!');
                            location.reload();
                        },
                        error: function (response) {
                            alert('Terjadi kesalahan saat memperbarui data.');
                            console.log(response);
                        }
                    });
                }
            }
        });
    });
</script>
@endsection
