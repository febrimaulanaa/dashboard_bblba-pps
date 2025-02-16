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
                                    <h4 class="card-title">Data Peserta Seminar</h4>
                                </div>
                                <div class="d-grid gap-2 d-md-block">
                                    <a class="btn btn-success my-3" data-toggle="modal" data-target="#ajaxModel">ADD
                                        DATA</a>
                                    <a href="{{ route('exportseminar') }}" class="btn btn-success my-3">EXPORT EXCEL</a>
                                    <button type="button" class="btn btn-primary mr-5" data-toggle="modal"
                                        data-target="#importExcel">
                                        IMPORT EXCEL
                                    </button>

                                    {{-- Tambah Data --}}
                                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
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
                                    </div>

                                    <!-- Import Excel -->
                                    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form method="post" action="{{ route('importseminar') }}"
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
                                                <th>Nama</th>
                                                <th>NIM</th>
                                                <th>Prodi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($seminar as $i)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $i->masa }}</td>
                                                    <td>{{ $i->nama }}</td>
                                                    <td>{{ $i->nim }}</td>
                                                    <td>{{ $i->prodi }}</td>
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
        $(document).ready(function() {
            let table = $('#example').DataTable();

            $('#savedata').on('click', function() {
                var masa = $('#masa').val();
                var nama = $('#nama').val();
                var nim = $('#nim').val();
                var prodi = $('#prodi').val();
                var _url = '/seminar/storeseminar';
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
                        console.log(data)
                        seminar = data

                        table.row.add([
                            '{{ $no }}',
                            data.masa,
                            data.nama,
                            data.nim,
                            data.prodi,
                        ]).draw();

                        $('#masa').val('');
                        $('#nama').val('');
                        $('#nim').val('');
                        $('#prodi').val('');

                        $('#ajaxModel').modal('hide');
                    },
                    error: function(response) {
                        $('#taskError').text(response.responseJSON.errors.seminar);
                    }
                });
            })
        });
    </script>
@endsection
