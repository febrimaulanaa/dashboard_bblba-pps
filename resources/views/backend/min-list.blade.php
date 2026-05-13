@extends('backend.layout-min')
@section('content')
<div class="box">
    <h2>{{ $title }}</h2>
    <p><a href="/admin301097">&laquo; Kembali</a></p>
    <table>
        <thead><tr><th>No</th>@foreach($fields as $f)<th>{{ ucfirst($f) }}</th>@endforeach</tr></thead>
        <tbody>
            @php $no=1; @endphp
            @foreach($data as $row)
            <tr><td>{{ $no++ }}</td>@foreach($fields as $f)<td>{{ $row->$f }}</td>@endforeach</tr>
            @endforeach
        </tbody>
    </table>
    <p>Total: {{ $data->count() }}</p>
</div>
@endsection