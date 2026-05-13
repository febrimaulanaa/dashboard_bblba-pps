@extends('backend.layout-stitch')

@section('title', 'Dashboard')

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

<!-- Quick Access -->
<div class="card">
    <h3 style="margin-bottom: 15px; font-size: 16px; font-weight: 600;">Quick Access</h3>
    <div class="quick-links">
        <a href="/admin301097/pkbjj" class="quick-link">Data PKBJJ</a>
        <a href="/admin301097/osmb" class="quick-link">Data OSMB</a>
        <a href="/admin301097/seminar" class="quick-link">Data Seminar</a>
        <a href="/admin301097/wtku" class="quick-link">Data WTKU</a>
        <a href="/admin301097/wisuda" class="quick-link">Data Wisuda</a>
        <a href="/admin301097/tuweb" class="quick-link">Jadwal Tuweb</a>
        <a href="/admin301097/jadwalpkbjj" class="quick-link">Jadwal PKBJJ</a>
        <a href="/admin301097/users" class="quick-link">Pegawai</a>
        <a href="/admin301097/absensi" class="quick-link">Absensi</a>
        <a href="/admin301097/sistem-sertifikat" class="quick-link">Sistem Sertifikat</a>
    </div>
</div>

<!-- Summary Table -->
<div class="card">
    <h3 style="margin-bottom: 15px; font-size: 16px; font-weight: 600;">Ringkasan Data</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jumlah Data</th>
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