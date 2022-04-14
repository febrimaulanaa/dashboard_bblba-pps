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
                                    <h4 class="card-title">Data Peserta PKBJJ</h4>
                                </div>
                                <div class="d-grid gap-2 d-md-block">
                                    <a href="{{ route('export') }}" class="btn btn-success my-3">EXPORT EXCEL</a>
                                    <button type="button" class="btn btn-primary mr-5" data-toggle="modal"
                                        data-target="#importExcel">
                                        IMPORT EXCEL
                                    </button>

                                    <!-- Import Excel -->
                                    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form method="post" action="{{ route('import') }}"
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
                                            @foreach ($pkbjj as $i)
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
            $('#example').DataTable();
        });
    </script>
@endsection
