@extends('backend.template.master')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h4 class="card-title">Data Tuweb Mahasiswa</h4>
                                </div>
                                <div class="d-grid gap-2 d-md-block">
                                    <a class="btn btn-success my-3" data-toggle="modal" data-target="#ajaxModel">ADD
                                        DATA</a>
                                    <a href="{{ route('exporttuweb') }}" class="btn btn-info my-3">EXPORT EXCEL</a>
                                    <button type="button" class="btn btn-primary mr-5" data-toggle="modal"
                                        data-target="#importExcel">
                                        IMPORT EXCEL
                                    </button>

                                    {{-- Tambah Data --}}
                                    {{-- <div class="modal fade" id="ajaxModel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modalHeading">Tambah Mahasiswa</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {{ csrf_field() }}
                                                    <form id="dataForm" name="dataForm" class="form-horizontal">
                                                        <div class="form-group">
                                                            Masa: <br>
                                                            <input type="text" class="form-control" id="masa"
                                                                name="masa" placeholder="">
                                                            <span id="taskError" class="alert-message"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            Nama: <br>
                                                            <input type="text" class="form-control" id="nama"
                                                                name="nama" placeholder="">
                                                            <span id="taskError" class="alert-message"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            Nim: <br>
                                                            <input type="text" class="form-control" id="nim"
                                                                name="nim" placeholder="">
                                                            <span id="taskError" class="alert-message"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            Prodi: <br>
                                                            <input type="text" class="form-control" id="prodi"
                                                                name="prodi" placeholder="">
                                                            <span id="taskError" class="alert-message"></span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button id="savedata" type="button"
                                                                class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let number = 1
        $(document).ready(function() {
            let url = "{!! route('getosmb') !!}"
            let table = $('#example').DataTable()

            $('#savedata').on('click', function() {
                var masa = $('#masa').val();
                var nama = $('#nama').val();
                var nim = $('#nim').val();
                var prodi = $('#prodi').val();
                var _url = '/osmb/storeosmb';
                // var _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: _url,
                    type: "POST",
                    dataType: "json",
                    data: {
                        masa: masa,
                        nama: nama,
                        nim: nim,
                        prodi: prodi,
                        // _token: _token
                    },
                    success: function(data) {
                        osmb = data

                        table.row.add([
                            '{{ $no }}',
                            data.masa,
                            data.nama,
                            data.nim,
                            data.prodi,

                            "o"
                        ]).draw();
                        // table.ajax.reload()
                        // number = 1

                        $('#masa').val('');
                        $('#nama').val('');
                        $('#nim').val('');
                        $('#prodi').val('');

                        $('#ajaxModel').modal('hide');
                    },
                    error: function(response) {
                        $('#taskError').text(response.responseJSON.errors.osmb);
                    }
                });
            })
        });
    </script>
@endsection
