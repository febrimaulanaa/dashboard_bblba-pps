@extends('backend.layout-admin')
@section('title', 'Data Tuweb')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="card-title mb-0">Data Tuweb Mahasiswa</h4>
    </div>
    <div class="card-body">
                                <div class="d-grid gap-2 d-md-block">
                                    <a class="btn btn-success my-3" data-toggle="modal" data-target="#ajaxModel">ADD
                                        DATA</a>
                                    <a href="{{ route('exporttuweb') }}" class="btn btn-info my-3">EXPORT EXCEL</a>
                                    <button type="button" class="btn btn-primary mr-5" data-toggle="modal"
                                        data-target="#importExcel">
                                        IMPORT EXCEL
                                    </button>

                                    <!-- Tambah Data Modal -->
                                    <div class="modal fade" id="ajaxModel" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modalHeading">Tambah Jadwal Tuweb</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="dataForm" name="dataForm" class="form-horizontal">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label>Masa</label>
                                                                <input type="text" class="form-control" id="masa" name="masa" placeholder="Contoh: 2024.1">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>NIM</label>
                                                                <input type="text" class="form-control" id="nim" name="nim">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Nama Mahasiswa</label>
                                                                <input type="text" class="form-control" id="nama_mhs" name="nama_mhs">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Nama Tutor</label>
                                                                <input type="text" class="form-control" id="nama_tutor" name="nama_tutor">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Kode Matkul</label>
                                                                <input type="text" class="form-control" id="kode_matkul" name="kode_matkul">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Nama Matkul</label>
                                                                <input type="text" class="form-control" id="nama_matkul" name="nama_matkul">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Lokasi</label>
                                                                <input type="text" class="form-control" id="lokasi" name="lokasi">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Link Tuweb (Opsional)</label>
                                                                <input type="text" class="form-control" id="link_tuweb" name="link_tuweb">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Hari</label>
                                                                <input type="text" class="form-control" id="hari" name="hari" placeholder="Contoh: Senin">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Jam</label>
                                                                <input type="text" class="form-control" id="jam" name="jam" placeholder="Contoh: 08:00 - 10:00">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Tanggal Mulai</label>
                                                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label>Tanggal Selesai</label>
                                                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label>Keterangan</label>
                                                                <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
                                                            </div>
                                                        </div>
                                                        <span id="taskError" class="text-danger mt-2 d-block"></span>
                                                        <div class="modal-footer mt-3 p-0 pt-3">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button id="savedata" type="button" class="btn btn-primary">Save Jadwal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Import Excel -->
                                    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form method="post" action="{{ route('importtuweb') }}"
                                                enctype="multipart/form-data">
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
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Import</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Masa</th>
                                                <th>Nim</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Nama Tutor</th>
                                                <th>Kode Matkul</th>
                                                <th>Nama Matkul</th>
                                                <th>Link Tuweb</th>
                                                <th>Lokasi</th>
                                                <th>Jam</th>
                                                <th>Hari</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Keterangan</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($tuweb as $t)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $t->masa }}</td>
                                                    <td>{{ $t->nim }}</td>
                                                    <td>{{ $t->nama_mhs }}</td>
                                                    <td>{{ $t->nama_tutor }}</td>
                                                    <td>{{ $t->kode_matkul }}</td>
                                                    <td>{{ $t->nama_matkul }}</td>
                                                    <td>{{ $t->link_tuweb }}</td>
                                                    <td>{{ $t->lokasi }}</td>
                                                    <td>{{ $t->jam }}</td>
                                                    <td>{{ $t->hari }}</td>
                                                    <td>{{ $t->tanggal_mulai }}</td>
                                                    <td>{{ $t->tanggal_selesai }}</td>
                                                    <td>{{ $t->nama_tutor }}</td>
                                                    <td>
                                                        <a data-id="{{ $t->id }}" class="btn btn-info">Edit</a>
                                                        <a class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            let table = $('#example').DataTable();

            $('#savedata').on('click', function() {
                // Reset validasi tampilan
                $('.form-control').removeClass('is-invalid border-danger');
                $('#taskError').text('');

                // Daftar field wajib (keterangan dan link_tuweb opsional)
                let requiredFields = ['masa', 'nim', 'nama_mhs', 'nama_tutor', 'kode_matkul', 'nama_matkul', 'lokasi', 'hari', 'jam', 'tanggal_mulai', 'tanggal_selesai'];
                let isValid = true;

                // Loop untuk cek input yang kosong
                requiredFields.forEach(function(field) {
                    let input = $('#' + field);
                    if (!input.val().trim()) {
                        input.addClass('is-invalid border-danger');
                        isValid = false;
                    }
                });

                if (!isValid) {
                    $('#taskError').text('Gagal menyimpan. Harap isi semua kolom bertanda merah.');
                    return; // Hentikan eksekusi
                }

                var formData = {
                    masa: $('#masa').val(),
                    nim: $('#nim').val(),
                    nama_mhs: $('#nama_mhs').val(),
                    nama_tutor: $('#nama_tutor').val(),
                    kode_matkul: $('#kode_matkul').val(),
                    nama_matkul: $('#nama_matkul').val(),
                    link_tuweb: $('#link_tuweb').val(),
                    lokasi: $('#lokasi').val(),
                    jam: $('#jam').val(),
                    hari: $('#hari').val(),
                    tanggal_mulai: $('#tanggal_mulai').val(),
                    tanggal_selesai: $('#tanggal_selesai').val(),
                    keterangan: $('#keterangan').val()
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/tuweb/storetuweb',
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    success: function(data) {
                        $('#ajaxModel').modal('hide');
                        $('#dataForm')[0].reset();
                        window.location.reload(); // Reload immediately so new rows appear with actions properly
                    },
                    error: function(response) {
                        $('#taskError').text('Gagal menyimpan. Pastikan semua kolom penting terisi.');
                    }
                });
            })
        });
    </script>
@endsection
