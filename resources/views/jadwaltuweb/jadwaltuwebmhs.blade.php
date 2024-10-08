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
                            <h2 class="text-dark mb-0">Cek Jadwal Tutorial Tatap Muka/Tutorial Webinar Mahasiswa
                            </h2>
                            <h2 class="text-primary text-gradient">Universitas Terbuka Jakarta</h2>
                            {{-- <p class="lead">We have created multiple options for you to put together and customise
                                into pixel perfect pages. </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h4>Nomor Induk Mahasiswa</h4>
                    <input type="text" id="data-id" class='form-control' name="nim" placeholder="Isikan NIM">
                    <br>
                    <button type="button" id="get-data" class="btn btn-primary">Cek Jadwal</button>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div id="result" class="mt-4">
                            <!-- Hasil data akan ditampilkan di sini -->
                            <p class="text-center text-muted">Data akan muncul di sini setelah pencarian.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#get-data').on('click', function() {
                    var id = $('#data-id').val();

                    if (id) {
                        $.ajax({
                            url: '/data/' + id,
                            type: 'GET',
                            success: function(data) {
                                if (data.length > 0) {
                                    var tableHtml = `
                            <div class="table-responsive">
                                <table class="table table-bordered transparent-table">
                                    <thead>
                                        <tr class="table-light">
                                            <th>ID</th>
                                            <th>Masa</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Nama Tutor</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;
                                    data.forEach(function(item) {
                                        tableHtml += `
                                <tr>
                                    <td>${item.id}</td>
                                    <td>${item.masa}</td>
                                    <td>${item.nim}</td>
                                    <td>${item.nama_mhs}</td>
                                    <td>${item.nama_tutor}</td>
                                </tr>`;
                                    });
                                    tableHtml += `</tbody></table></div>`;
                                    $('#result').html(tableHtml);
                                } else {
                                    $('#result').html(
                                        '<p class="text-danger text-center">Data tidak ditemukan.</p>'
                                    );
                                }
                            },
                            error: function() {
                                $('#result').html(
                                    '<p class="text-danger text-center">Terjadi kesalahan saat mengambil data.</p>'
                                );
                            }
                        });
                    } else {
                        $('#result').html(
                            '<p class="text-warning text-center">Masukkan ID terlebih dahulu.</p>');
                    }
                });
            });
        </script>

    </body>

    </html>
@endsection
