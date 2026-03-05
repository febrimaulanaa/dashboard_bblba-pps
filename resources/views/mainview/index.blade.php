@extends('template.master')

@section('content')
    <header class="header-2">
        <div class="page-header min-vh-75 relative" style="background-image: url('./assets/img/backut.png')">
            <div class="position-absolute w-100 z-index-1 bottom-0">
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 40">
                    <defs>
                        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="moving-waves">
                        <use href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40)" />
                        <use href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                        <use href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                        <use href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                    </g>
                </svg>
            </div>
        </div>
    </header>

    <section class="my-5 py-5">

        <!-- TITLE -->
        <div class="container text-center mb-5">
            <h2 class="text-dark">Dashboard BBLBA</h2>
            <h2 class="text-primary text-gradient">Universitas Terbuka Jakarta</h2>
        </div>

        <!-- ================= SERTIFIKAT ================= -->
        <div class="container mb-5">
            <div class="row">

                <div class="col-lg-3">
                    <h3>Sertifikat</h3>
                    <p class="text-secondary">Menu untuk cetak sertifikat</p>
                </div>

                <div class="col-lg-9">
                    <div class="row g-4">

                        <div class="col-md-3">
                            <a href="{{ route('sertifosmb') }}">
                                <div class="card dashboard-card">
                                    <img src="{{ asset('assets/img/sertifikat2.png') }}" class="menu-img">
                                    <h6>Sertifikat OSMB</h6>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('sertif') }}">
                                <div class="card dashboard-card">
                                    <img src="{{ asset('assets/img/sertifikat.png') }}" class="menu-img">
                                    <h6>Sertifikat PKBJJ</h6>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('sertifwtku') }}">
                                <div class="card dashboard-card">
                                    <img src="{{ asset('assets/img/sertifikat4.png') }}" class="menu-img">
                                    <h6>Sertifikat WTKU</h6>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('sertifseminar') }}">
                                <div class="card dashboard-card">
                                    <img src="{{ asset('assets/img/sertifikat3.png') }}" class="menu-img">
                                    <h6>Sertifikat Seminar</h6>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- ================= JADWAL TUTORIAL ================= -->

        <div class="container mb-5">
            <div class="row">

                <div class="col-lg-3">
                    <h3>Jadwal Tutorial</h3>
                    <p class="text-secondary">Menu untuk melihat jadwal TTM / Tuweb</p>
                </div>

                <div class="col-lg-9">
                    <div class="row g-4">

                        <div class="col-md-3">
                            <a href="javascript:void(0)" class="menu-disabled">
                                <div class="card dashboard-card">
                                    <img src="{{ asset('assets/img/jadwal.png') }}" class="menu-img">
                                    <h6>
                                        Jadwal Tutorial
                                        <span class="badge bg-warning">Coming Soon</span>
                                    </h6>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- ================= WISUDA ================= -->

        <div class="container mb-5">
            <div class="row">

                <div class="col-lg-3">
                    <h3>Wisuda</h3>
                    <p class="text-secondary">Menu untuk melihat meja pengambilan ijazah</p>
                </div>

                <div class="col-lg-9">
                    <div class="row g-4">

                        <div class="col-md-3">
                            <a href="{{ route('mejaijazah') }}">
                                <div class="card dashboard-card">
                                    <img src="{{ asset('assets/img/jadwal.png') }}" class="menu-img">
                                    <h6>Nomor Meja</h6>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
