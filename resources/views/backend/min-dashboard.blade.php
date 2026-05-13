@extends('backend.layout-min')
@section('content')
<div class="box">
    <h2>Dashboard</h2>
    <p>PKBJJ: {{ \App\Models\DataSertifMhs::count() }} | OSMB: {{ \App\Models\DataSertifOSMB::count() }} | Wisuda: {{ \App\Models\Wisuda::count() }}</p>
    <p><a href="/admin301097/pkbjj">Lihat Data</a></p>
</div>
@endsection