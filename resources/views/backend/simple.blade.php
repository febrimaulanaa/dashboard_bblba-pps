@extends('backend.layout-admin')

@section('content')
<div class="page-title">Dashboard Overview</div>

<div class="stats-grid">
    <div class="stat-card">
        <h2>{{ \App\Models\DataSertifMhs::count() }}</h2>
        <p>Mahasiswa PKBJJ</p>
    </div>
    <div class="stat-card warning">
        <h2>{{ \App\Models\DataSertifOSMB::count() }}</h2>
        <p>Mahasiswa OSMB</p>
    </div>
    <div class="stat-card success">
        <h2>{{ \App\Models\Wisuda::count() }}</h2>
        <p>Mahasiswa Wisuda</p>
    </div>
    <div class="stat-card">
        <h2>{{ \App\Models\JadwalTuweb::count() }}</h2>
        <p>Jadwal Tuweb</p>
    </div>
</div>

<div class="card">
    <h4 style="margin-bottom: 15px;">Statistik Lengkap</h4>
    <table class="table">
        <tr>
            <td>Mahasiswa PKBJJ</td>
            <td><strong>{{ \App\Models\DataSertifMhs::count() }}</strong></td>
        </tr>
        <tr>
            <td>Mahasiswa OSMB</td>
            <td><strong>{{ \App\Models\DataSertifOSMB::count() }}</strong></td>
        </tr>
        <tr>
            <td>Mahasiswa Seminar</td>
            <td><strong>{{ \App\Models\DataSertifSeminar::count() }}</strong></td>
        </tr>
        <tr>
            <td>Mahasiswa WTKU</td>
            <td><strong>{{ \App\Models\DataSertifWTKU::count() }}</strong></td>
        </tr>
        <tr>
            <td>Wisuda</td>
            <td><strong>{{ \App\Models\Wisuda::count() }}</strong></td>
        </tr>
        <tr>
            <td>Jadwal Tuweb</td>
            <td><strong>{{ \App\Models\JadwalTuweb::count() }}</strong></td>
        </tr>
        <tr>
            <td>Jadwal PKBJJ</td>
            <td><strong>{{ \App\Models\JadwalPKBJJ::count() }}</strong></td>
        </tr>
        <tr>
            <td>Pegawai</td>
            <td><strong>{{ \App\Models\User::count() }}</strong></td>
        </tr>
        <tr>
            <td>Events Sertifikat</td>
            <td><strong>{{ \App\Models\CertificateEvent::count() }}</strong></td>
        </tr>
        <tr>
            <td>Peserta Sertifikat</td>
            <td><strong>{{ \App\Models\CertificateParticipant::count() }}</strong></td>
        </tr>
    </table>
</div>

<div class="card">
    <h4 style="margin-bottom: 15px;">Menu Cepat</h4>
    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
        <a href="/admin301097/pkbjj" class="btn btn-primary">Data PKBJJ</a>
        <a href="/admin301097/osmb" class="btn btn-primary">Data OSMB</a>
        <a href="/admin301097/seminar" class="btn btn-primary">Data Seminar</a>
        <a href="/admin301097/wtku" class="btn btn-primary">Data WTKU</a>
        <a href="/admin301097/wisuda" class="btn btn-primary">Data Wisuda</a>
        <a href="/admin301097/tuweb" class="btn btn-primary">Data Tuweb</a>
        <a href="/admin301097/jadwalpkbjj" class="btn btn-primary">Jadwal PKBJJ</a>
        <a href="/admin301097/users" class="btn btn-success">Manajemen Pegawai</a>
        <a href="/admin301097/absensi" class="btn btn-success">Absensi</a>
        <a href="/admin301097/sistem-sertifikat" class="btn btn-danger">Sistem Sertifikat</a>
    </div>
</div>
@endsection