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

            <table id="basic-datatables" class="w-full text-sm">

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
                            {{ $index + 1 }}
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
                                Kelas: {{ $row->id_kelas_tutorial }}
                            </div>

                        </td>

                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $row->jml_mhs_hadir }} /
                            {{ $row->jml_mhs_seharusnya }}
                        </td>

                        <td class="px-4 py-4">

                            @if($row->latitude && $row->longitude)

                                <a href="https://www.google.com/maps?q={{ $row->latitude }},{{ $row->longitude }}"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">

                                    Lihat Lokasi

                                </a>

                            @else

                                -

                            @endif

                        </td>

                        <td class="px-4 py-4 space-y-2">

                            @if($row->file_materi)
                                <a href="{{ $row->file_materi }}"
                                   target="_blank"
                                   class="block text-blue-600 hover:underline">

                                    File Materi

                                </a>
                            @endif

                            @if($row->file_peserta)
                                <a href="{{ $row->file_peserta }}"
                                   target="_blank"
                                   class="block text-blue-600 hover:underline">

                                    File Peserta

                                </a>
                            @endif

                            @if($row->link_video)
                                <a href="{{ $row->link_video }}"
                                   target="_blank"
                                   class="block text-red-600 hover:underline">

                                    Video

                                </a>
                            @endif

                        </td>

                        <td class="px-4 py-4 whitespace-nowrap">

                            <div>
                                {{ $row->created_at ? $row->created_at->format('d M Y') : '-' }}
                            </div>

                            <div class="text-xs text-gray-400 mt-1">
                                {{ $row->created_at ? $row->created_at->format('H:i:s') : '' }}
                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="10" class="text-center py-10 text-gray-400">
                            Belum ada data monitoring.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@section('custom_script')

<script>

$(document).ready(function() {

    $('#basic-datatables').DataTable({
        order: [[0, 'desc']],
        pageLength: 10
    });

});

</script>

@endsection