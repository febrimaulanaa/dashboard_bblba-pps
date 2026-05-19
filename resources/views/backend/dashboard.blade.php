@extends('backend.layout-admin')
@section('title', 'Dashboard Utama')

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-primary card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Mahasiswa PKBJJ</p>
                            <h4 class="card-title">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-info card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Mahasiswa OSMB</p>
                            <h4 class="card-title">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-success card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Wisuda</p>
                            <h4 class="card-title">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-secondary card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Jadwal Tuweb</p>
                            <h4 class="card-title">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-4">
    <div class="card-header bg-white">
        <h4 class="card-title mb-0">Ringkasan Data Akademik</h4>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th width="20%">Jumlah Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>Mahasiswa PKBJJ</td><td><strong>0</strong></td></tr>
                    <tr><td>2</td><td>Mahasiswa OSMB</td><td><strong>0</strong></td></tr>
                    <tr><td>3</td><td>Mahasiswa Seminar</td><td><strong>0</strong></td></tr>
                    <tr><td>4</td><td>Mahasiswa WTKU</td><td><strong>0</strong></td></tr>
                    <tr><td>5</td><td>Mahasiswa Wisuda</td><td><strong>0</strong></td></tr>
                    <tr><td>6</td><td>Jadwal Tuweb</td><td><strong>0</strong></td></tr>
                    <tr><td>7</td><td>Jadwal PKBJJ</td><td><strong>0</strong></td></tr>
                    <tr><td>8</td><td>Data Pegawai</td><td><strong>0</strong></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
