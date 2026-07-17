@extends('backend.layout-admin')
@section('title', 'Jadwal LPKBJJ')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="card-title mb-0">Data Peserta Kegiatan LPKBJJ</h4>
    </div>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-success my-3" id="btn-add-new" data-toggle="modal" data-target="#ajaxModel">ADD DATA</button>
            <button type="button" class="btn btn-primary mr-5 my-3" data-toggle="modal" data-target="#importExcel">
                IMPORT EXCEL
            </button>

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
                                    Link / Lokasi: <br>
                                    <input type="text" class="form-control" id="link_lok" name="link_lok" placeholder="Masukkan Link atau Lokasi" required>
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
        </div>
        <div class="table-responsive">
            <table id="example" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Waktu</th>
                        <th>Skema</th>
                        <th>Nomor Meja</th>
                        <th>No Urut</th>
                        <th>Link / Lokasi</th>
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
                            <td>{{ $p->tanggal }}</td>
                            <td>{{ $p->waktu }}</td>
                            <td>{{ $p->skema }}</td>
                            <td>{{ $p->nomor_meja }}</td>
                            <td>{{ $p->no_urut }}</td>
                            <td>{{ $p->link_lok }}</td>
                            <td>
                                <button data-id="{{ $p->id }}"
                                        data-nim="{{ $p->nim }}"
                                        data-nama="{{ $p->nama }}"
                                        data-tanggal="{{ $p->tanggal }}"
                                        data-waktu="{{ $p->waktu }}"
                                        data-skema="{{ $p->skema }}"
                                        data-nomor_meja="{{ $p->nomor_meja }}"
                                        data-no_urut="{{ $p->no_urut }}"
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
            $('#tanggal').val($(this).data('tanggal'));
            $('#waktu').val($(this).data('waktu'));
            $('#skema').val($(this).data('skema'));
            $('#nomor_meja').val($(this).data('nomor_meja'));
            $('#no_urut').val($(this).data('no_urut'));
            $('#link_lok').val($(this).data('link_lok'));
            $('#ajaxModel').modal('show');
        });

        $('#dataForm').on('submit', function (e) {
            e.preventDefault();
            var id = $('#jadwal_id').val();
            var url = id ? '/pkbjj/updatejadwalpkbjj/' + id : '{{ route("storejadwalpkbjj") }}';
            var method = id ? 'PUT' : 'POST';

            $.ajax({
                data: $(this).serialize(),
                url: url,
                type: method,
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
                    type: "DELETE",
                    url: '/pkbjj/deletejadwalpkbjj/' + id,
                    success: function (data) {
                        $("#tr_" + id).remove();
                        alert('Data berhasil dihapus!');
                    },
                    error: function (data) {
                        alert('Error: Data gagal dihapus!');
                        console.log('Error:', data);
                    }
                });
            }
        });
    });
</script>
@endsection
