@extends('backend.layout-light')
@section('content')
<h2 style="margin-bottom: 15px;">Dashboard</h2>
<div class="stats">
    <div class="stat-box"><h2>{{ \App\Models\DataSertifMhs::count() }}</h2><p>PKBJJ</p></div>
    <div class="stat-box"><h2>{{ \App\Models\DataSertifOSMB::count() }}</h2><p>OSMB</p></div>
    <div class="stat-box"><h2>{{ \App\Models\Wisuda::count() }}</h2><p>Wisuda</p></div>
    <div class="stat-box"><h2>{{ \App\Models\JadwalTuweb::count() }}</h2><p>Tuweb</p></div>
</div>
<div class="card">
    <p><strong>Total Keseluruhan:</strong></p>
    <p>Seminar: {{ \App\Models\DataSertifSeminar::count() }} | WTKU: {{ \App\Models\DataSertifWTKU::count() }} | Pegawai: {{ \App\Models\User::count() }}</p>
</div>
@endsection