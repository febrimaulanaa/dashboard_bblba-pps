@extends('backend.layout-admin')

@section('content')
<h2 style="margin-bottom: 20px;">Dashboard Overview</h2>

<div class="stats">
    <div class="stat"><h2>{{ \App\Models\DataSertifMhs::count() }}</h2><p>PKBJJ</p></div>
    <div class="stat"><h2>{{ \App\Models\DataSertifOSMB::count() }}</h2><p>OSMB</p></div>
    <div class="stat"><h2>{{ \App\Models\Wisuda::count() }}</h2><p>Wisuda</p></div>
    <div class="stat"><h2>{{ \App\Models\JadwalTuweb::count() }}</h2><p>Tuweb</p></div>
</div>

<div class="card">
    <h3>Menu Cepat</h3>
    <a href="/admin301097/pkbjj" class="btn btn-primary">PKBJJ</a>
    <a href="/admin301097/osmb" class="btn btn-primary">OSMB</a>
    <a href="/admin301097/seminar" class="btn btn-primary">Seminar</a>
    <a href="/admin301097/wtku" class="btn btn-primary">WTKU</a>
    <a href="/admin301097/wisuda" class="btn btn-primary">Wisuda</a>
    <a href="/admin301097/tuweb" class="btn btn-primary">Tuweb</a>
    <a href="/admin301097/users" class="btn btn-primary">Pegawai</a>
    <a href="/admin301097/absensi" class="btn btn-primary">Absensi</a>
</div>
@endsection