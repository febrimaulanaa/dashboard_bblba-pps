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
                            <h2 class="text-dark mb-0">Form Cek Meja Absensi Mahasiswa
                            </h2>
                            <h2 class="text-primary text-gradient">Universitas Terbuka Jakarta</h2>
                            {{-- <p class="lead">We have created multiple options for you to put together and customise
                                into pixel perfect pages. </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <form action="{{ route('cetakmejaijazah') }}" method="post">
                        {{ csrf_field() }}
                        <h4>Nomor Induk Mahasiswa</h4>
                        <input type="text" class='form-control' name="nim" placeholder="Isikan NIM">
                        <br>
                        <button type="submit" class="btn btn-primary">Cek Nomor Meja Ijazah</button>
                    </form>
                </div>
            </div>
        </section>
        <section class="pt-3 pb-4" id="count-stats">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 z-index-2 ">
                        <div class="row">
                            {{-- <div class="col-md-5 position-relative">
                                <div class="p-3 text-center">
                                    @if (count($usersData) > 0)
                                        <h1 class="text-gradient text-primary"><span id="state1"
                                                countTo="{{ count($usersData) }}">0</span>
                                        </h1>
                                        <h5 class="mt-3">Total Peserta</h5>
                                        <p class="text-sm">Seminar Akademik</p>
                                </div>
                                <hr class="horizontal dark">
                                @endif
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>


    </body>

    </html>
@endsection
