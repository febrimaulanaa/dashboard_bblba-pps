@extends('backend.layout-min')
@section('content')
<div class="box">
    <h2>{{ $title }}</h2>
    <p><a href="/admin301097">&laquo; Kembali</a></p>
    
    <!-- Import Form -->
    <div style="margin: 15px 0; padding: 15px; background: #f9f9f9; border-radius: 5px;">
        <h4>Import Data (Excel)</h4>
        <form action="{{ route('import'.strtolower($model)) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
            @csrf
            <input type="file" name="file" required style="margin: 5px 0;">
            <button type="submit" class="btn" style="background: #006191; color: white; padding: 5px 10px; border:none; cursor:pointer;">Import</button>
        </form>
        <a href="{{ route('export'.strtolower($model)) }}" class="btn" style="background: #28a745; color: white; padding: 5px 10px; text-decoration: none; margin-left: 10px;">Export</a>
    </div>
    
    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                @foreach($fields as $f)
                <th>{{ ucfirst($f) }}</th>
                @endforeach
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach($data as $row)
            <tr>
                <td>{{ $no++ }}</td>
                @foreach($fields as $f)
                <td>{{ $row->$f }}</td>
                @endforeach
                <td>
                    @if(isset($row->id))
                    <form action="{{ route('delete'.strtolower($model), $row->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus?')" style="background: #dc3545; color: white; border: none; padding: 3px 8px; cursor:pointer;">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total: {{ $data->count() }}</p>
</div>
@endsection