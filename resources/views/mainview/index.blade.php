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
        {{-- <section class="pt-3 pb-4" id="count-stats">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 z-index-2 border-radius-xl mt-n10 mx-auto py-3 blur shadow-blur">
                        <div class="row">
                            <div class="col-md-4 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"><span id="state1" countTo="70">0</span>+</h1>
                                    <h5 class="mt-3">Coded Elements</h5>
                                    <p class="text-sm">From buttons, to inputs, navbars, alerts or cards, you are
                                        covered</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-4 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">0</span>+</h1>
                                    <h5 class="mt-3">Design Blocks</h5>
                                    <p class="text-sm">Mix the sections, change the colors and unleash your
                                        creativity</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary" id="state3" countTo="4">0</h1>
                                    <h5 class="mt-3">Pages</h5>
                                    <p class="text-sm">Save 3-4 weeks of work when you use our pre-made pages for
                                        your website</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <section class="my-5 py-5">
            <div class="container">
                <div class="row">
                    <div class="row justify-content-center text-center my-sm-5">
                        <div class="col-lg-6">
                            <h2 class="text-dark mb-0">Dashboard BBLBA & PPS</h2>
                            <h2 class="text-primary text-gradient">Universitas Terbuka Jakarta</h2>
                            {{-- <p class="lead">We have created multiple options for you to put together and customise
                                into pixel perfect pages. </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-sm-5 mt-3">
                <div class="row pt-lg-6">
                    <div class="col-lg-3">
                        <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
                            <h3>Sertifikat</h3>
                            <h6 class="text-secondary font-weight-normal pe-3">Menu untuk cetak sertifikat</h6>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <a href="{{ route('sertifosmb') }}">
                                    <div class="card shadow-lg move-on-hover min-height-160 min-height-160">
                                        <img class="w-100 m-auto" src="{{ asset('assets/img/sertifikat2.png') }}"
                                            alt="">
                                    </div>
                                    <div class="mt-2 ms-2">
                                        <h6 class="mb-0">Sertifikat Orientasi Studi Mahasiswa Baru (OSMB)</h6>
                                        {{-- <p class="text-secondary text-sm">Sertifikat Orientasi Studi Mahasiswa Baru (OSMB)
                                        </p> --}}
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('sertif') }}">
                                    <div class="card shadow-lg move-on-hover min-height-160 min-height-160">
                                        <img class="w-100 m-auto" src="{{ asset('assets/img/sertifikat.png') }}"
                                            alt="">
                                    </div>
                                    <div class="mt-2 ms-2">
                                        <h6 class="mb-0">Sertifikat Pelatihan Keterampilan Belajar Jarak Jauh
                                            (PKBJJ)</h6>
                                        {{-- <p class="text-secondary text-sm">Sertifikat Pelatihan Keterampilan Belajar Jarak
                                            Jauh (PKBJJ)
                                        </p> --}}
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('sertifwtku') }}">
                                    <div class="card shadow-lg move-on-hover min-height-160 min-height-160">
                                        <img class="w-100 m-auto" src="{{ asset('assets/img/sertifikat4.png') }}"
                                            alt="">
                                    </div>
                                    <div class="mt-2 ms-2">
                                        <h6 class="mb-0">Sertifikat Workshop Tugas dan Klinik UAS</h6>
                                        {{-- <p class="text-secondary text-sm">Sertifikat Pelatihan Keterampilan Belajar Jarak
                                            Jauh (PKBJJ)
                                        </p> --}}
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('sertifseminar') }}">
                                    <div class="card shadow-lg move-on-hover min-height-160 min-height-160">
                                        <img class="w-100 m-auto" src="{{ asset('assets/img/sertifikat3.png') }}"
                                            alt="">
                                    </div>
                                    <div class="mt-2 ms-2">
                                        <h6 class="mb-0">Sertifikat Seminar Akademik</h6>
                                        {{-- <p class="text-secondary text-sm">Sertifikat Pelatihan Keterampilan Belajar Jarak
                                            Jauh (PKBJJ)
                                        </p> --}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-sm-5 mt-3">
                <div class="row pt-lg-6">
                    <div class="col-lg-3">
                        <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
                            <h3>LPKBJJ</h3>
                            <h6 class="text-secondary font-weight-normal pe-3">Menu Untuk Lihat Jadwal LPKBJJ</h6>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row mt-3">
                            <div class="col-md-4 mt-md-0 mt-4">
                                <a href="{{ route('jadwalpkbjj') }}">
                                    <div class="card shadow-lg move-on-hover min-height-160 min-height-160">
                                        <img class="w-100 m-auto" src="{{ asset('assets/img/jadwal.png') }}" alt="">
                                    </div>
                                    <div class="mt-2 ms-2">
                                        <h6 class="mb-0">Jadwal PKBJJ</h6>
                                        <p class="text-secondary text-sm">Jadwal Pelatihan Keterampilan Jarak Jauh 2023.1
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-sm-5 mt-3">
                <div class="row pt-lg-6">
                    <div class="col-lg-3">
                        <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
                            <h3>Wisuda Daerah</h3>
                            <h6 class="text-secondary font-weight-normal pe-3">Menu Untuk Lihat Nomor Meja Ijazah</h6>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row mt-3">
                            <div class="col-md-4 mt-md-0 mt-4">
                                <a href="{{ route('mejaijazah') }}">
                                    <div class="card shadow-lg move-on-hover min-height-160 min-height-160">
                                        <img class="w-100 m-auto" src="{{ asset('assets/img/meja2.png') }}" alt="">
                                    </div>
                                    <div class="mt-2 ms-2">
                                        <h6 class="mb-0">Nomor Meja Ijazah</h6>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="container mt-sm-5 mt-3">
                <div class="row pt-lg-6">
                    <div class="col-lg-3">
                        <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
                            <h3>Jadwal Tuweb</h3>
                            <h6 class="text-secondary font-weight-normal pe-3">Menu Untuk Lihat Jadwal Tuweb</h6>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row mt-3">
                            <div class="col-md-4 mt-md-0 mt-4">
                                <a href="{{ route('jadwaltuwebmhs') }}">
                                    <div class="card shadow-lg move-on-hover min-height-160 min-height-160">
                                        <img class="w-100 m-auto" src="{{ asset('assets/img/jadwal.png') }}"
                                            alt="">
                                    </div>
                                    <div class="mt-2 ms-2">
                                        <h6 class="mb-0">Jadwal Tuweb Mahasiswa</h6>
                                        <p class="text-secondary text-sm">Jadwal Tutorial Webinar (TUWEB) Mahasiswa
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </section>

    </body>

    </html>
@endsection
