@extends('backend.template.modern')

@section('title', 'Data Absensi Pegawai')
@section('content')
<div class="container mx-auto px-4 py-10 mt-20">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-[#006191]">
                    Data Monitoring Pegawai
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Total Data: {{ $absensis->total() }}
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-[#006191] text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama Pemantau</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Tutorial</th>
                        <th class="px-4 py-3 text-left">Tutor</th>
                        <th class="px-4 py-3 text-left">Matkul</th>
                        <th class="px-4 py-3 text-left">Kehadiran</th>
                        <th class="px-4 py-3 text-left">Lokasi GPS</th>
                        <th class="px-4 py-3 text-left">Dokumentasi</th>
                        <th class="px-4 py-3 text-left">Waktu Submit</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($absensis as $index => $row)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 align-top">

                            <td class="px-4 py-4">
                                {{ $absensis->firstItem() + $index }}
                            </td>

                            <td class="px-4 py-4">
                                <div class="font-semibold text-gray-800">
                                    {{ $row->nama_pemantau }}
                                </div>
                            </td>

                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $row->tanggal }}
                            </td>

                            <td class="px-4 py-4">
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                    {{ $row->jenis_tutorial }}
                                </span>
                            </td>

                            <td class="px-4 py-4">
                                <div class="font-medium">
                                    {{ $row->nama_tutor }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $row->id_tutor }}
                                </div>
                            </td>

                            <td class="px-4 py-4 max-w-[250px]">
                                <div class="font-medium text-gray-700">
                                    {{ $row->kode_nama_matkul_kelas }}
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 10
        });
        
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
