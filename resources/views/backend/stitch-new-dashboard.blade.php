@extends('backend.layout-stitch-new')

@section('page-title', 'Dashboard')
@section('breadcrumb', 'Overview')

@section('content')
<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">&#128100;</div>
        <div class="stat-info">
            <h3>{{ \App\Models\DataSertifMhs::count() }}</h3>
            <p>Mahasiswa PKBJJ</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">&#128100;</div>
        <div class="stat-info">
            <h3>{{ \App\Models\DataSertifOSMB::count() }}</h3>
            <p>Mahasiswa OSMB</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">&#127891;</div>
        <div class="stat-info">
            <h3>{{ \App\Models\Wisuda::count() }}</h3>
            <p>Mahasiswa Wisuda</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">&#128197;</div>
        <div class="stat-info">
            <h3>{{ \App\Models\JadwalTuweb::count() }}</h3>
            <p>Jadwal Tuweb</p>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="data-card">
    <div class="data-card-header">
        <h3>Menu Cepat</h3>
    </div>
    <div class="data-card-body" style="padding: 20px;">
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
            <a href="/admin301097/pkbjj" class="btn btn-primary">Data PKBJJ</a>
            <a href="/admin301097/osmb" class="btn btn-primary">Data OSMB</a>
            <a href="/admin301097/seminar" class="btn btn-primary">Data Seminar</a>
            <a href="/admin301097/wtku" class="btn btn-primary">Data WTKU</a>
            <a href="/admin301097/wisuda" class="btn btn-primary">Data Wisuda</a>
            <a href="/admin301097/tuweb" class="btn btn-primary">Jadwal Tuweb</a>
            <a href="/admin301097/users" class="btn btn-success">Pegawai</a>
            <a href="/admin301097/absensi" class="btn btn-success">Absensi</a>
            <a href="/admin301097/sistem-sertifikat" class="btn btn-danger">Sistem Sertifikat</a>
        </div>
    </div>
</div>

<!-- Summary Table -->
<div class="data-card" style="margin-top: 20px;">
    <div class="data-card-header">
        <h3>Ringkasan Data</h3>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>1</td><td>Mahasiswa PKBJJ</td><td>{{ \App\Models\DataSertifMhs::count() }}</td></tr>
                <tr><td>2</td><td>Mahasiswa OSMB</td><td>{{ \App\Models\DataSertifOSMB::count() }}</td></tr>
                <tr><td>3</td><td>Mahasiswa Seminar</td><td>{{ \App\Models\DataSertifSeminar::count() }}</td></tr>
                <tr><td>4</td><td>Mahasiswa WTKU</td><td>{{ \App\Models\DataSertifWTKU::count() }}</td></tr>
                <tr><td>5</td><td>Mahasiswa Wisuda</td><td>{{ \App\Models\Wisuda::count() }}</td></tr>
                <tr><td>6</td><td>Jadwal Tuweb</td><td>{{ \App\Models\JadwalTuweb::count() }}</td></tr>
                <tr><td>7</td><td>Jadwal PKBJJ</td><td>{{ \App\Models\JadwalPKBJJ::count() }}</td></tr>
                <tr><td>8</td><td>Pegawai</td><td>{{ \App\Models\User::count() }}</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection