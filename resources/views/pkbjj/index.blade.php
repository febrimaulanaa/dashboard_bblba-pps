@extends('template.master')

@section('content')

    <body class="presentation-page">
        <header class="header-2">
            <div class="page-header min-vh-75 relative" style="background-image: url('./assets/img/backut.png')">
                <div class="container">
                    <div class="row">
                        {{-- <div class="col-lg-7 text-center mx-auto">
                            <h1 class="text-white pt-3 mt-n5">Soft UI Design System</h1>
                            <p class="lead text-white mt-3">Free & Open Source Web UI Kit built over Bootstrap 5. <br /> Join
                                over 1.4 million developers around the world. </p>
                        </div> --}}
                    </div>
                </div>
                <div class="position-absolute w-100 z-index-1 bottom-0">
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave"
                                d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="moving-waves">
                            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
                            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
                        </g>
                    </svg>
                </div>
            </div>
        </header>



        <section class="my-5 py-5">
            <div class="container">
                <div class="row">
                    <div class="row justify-content-center text-center my-sm-5">
                        <div class="col-lg-6">
                            <h2 class="text-dark mb-0">Jadwal Kegiatan Pelatihan Keterampilan Belajar Jarak Jauh (PKBJJ)
                            </h2>
                            <h2 class="text-primary text-gradient">Universitas Terbuka Jakarta</h2>
                            {{-- <p class="lead">We have created multiple options for you to put together and customise
                                into pixel perfect pages. </p> --}}
                        </div>
                    </div>
                </div>

                {{-- Tambah Data --}}
                <div class="modal fade" id="ajaxModel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading">Jadwal PKBJJ</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    NIM : <br>
                                    <span id="nim"></span>
                                </div>
                                <div class="form-group">
                                    Nama : <br>
                                    <span id="nama"></span>
                                </div>
                                <div class="form-group">
                                    Tanggal Pelaksanaan : <br>
                                    <span id="tanggal"></span>
                                </div>
                                <div class="form-group">
                                    Skema :<br>
                                    <span id="skema"></span>
                                </div>
                                <div class="form-group">
                                    Link / Lokasi :<br>
                                    <span id="link_lok"></span>
                                </div>
                                <div class="modal-footer">
                                    <button id="close" type="button" class="btn btn-primary">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    {{-- <form action="" method="get"> --}}
                    <h4>Nomor Induk Mahasiswa</h4>
                    <input type="text" class='form-control' name="nim" placeholder="Isikan NIM">
                    <br>
                    <button id="showmodal" class="btn btn-primary" data-toggle="modal">Cek
                        Jadwal</button>
                    {{-- </form> --}}
                </div>
            </div>
        </section>



    </body>

    </html>
@endsection

@push('css')
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css " rel="stylesheet">
@endpush

@push('script')
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js "></script>

    <script>
        $(document).ready(function() {
            $("#close").click(function(e) {
                e.preventDefault()
                let modal = $("#ajaxModel")
                modal.modal('hide')
            })
            $("#showmodal").click(function(e) {
                e.preventDefault()
                let modal = $("#ajaxModel")
                let nim = $("input[name=nim]").val()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('cekjadwalpkbjj') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        nim: nim,
                    },
                    success: function(data) {
                        $('#nim').text(data.data.nim)
                        $('#nama').text(data.data.nama)
                        $('#tanggal').text(data.data.tanggal)
                        $('#skema').text(data.data.skema)
                        $('#link_lok').text(data.data.link_lok)
                        modal.modal('show')
                    },
                    error: function(response) {
                        Swal.fire({
                            titleText: 'Maaf Jadwal Tidak Ditemukan',
                            icon: 'warning',
                            text: 'Anda Tidak Terdaftar PKBJJ Gelombang Ini',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: 'Close',
                            cancelButtonColor: "#ff0005"

                        })
                    }
                });
            })
        })
    </script>
@endpush
