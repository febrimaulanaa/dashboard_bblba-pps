<div class="data-card">

    <div class="data-card-header">
        <h3>Data Absensi Pegawai (Monitoring)</h3>
    </div>

    <div class="data-card-body" style="overflow-x:auto;">

        @php
        try {
            $absensis = \App\Models\AbsensiPegawai::latest()->limit(100)->get();
            $total = \App\Models\AbsensiPegawai::count();
        } catch (\Exception $e) {
            $absensis = [];
            $total = 0;
        }

        $no = 1;
        @endphp

        <table class="table table-bordered table-striped" style="width:100%; min-width:2500px;">

            <thead>

                <tr>

                    <th>No</th>
                    <th>User ID</th>
                    <th>Nama Pemantau</th>
                    <th>Jenis Tutorial</th>
                    <th>Tanggal</th>
                    <th>Jam Tutorial</th>
                    <th>Pertemuan</th>

                    <th>Mata Kuliah</th>
                    <th>ID Kelas</th>

                    <th>ID Tutor</th>
                    <th>Nama Tutor</th>

                    <th>Jam Mulai Pantau</th>

                    <th>Jumlah Hadir</th>
                    <th>Jumlah Seharusnya</th>

                    <th>Jenis Pemantauan</th>

                    <th>KBM Absensi</th>
                    <th>KBM Materi</th>
                    <th>KBM Media</th>
                    <th>KBM Diskusi</th>
                    <th>KBM Pengarahan</th>
                    <th>Bahas Tugas</th>

                    <th>Jam Akhir Pantau</th>

                    <th>Praktik Baik</th>
                    <th>Temuan Ketidaksesuaian</th>
                    <th>Kesan Pembelajaran</th>
                    <th>Kendala Tutorial</th>
                    <th>Saran Perbaikan</th>

                    <th>File Materi</th>
                    <th>File Peserta</th>
                    <th>Video</th>

                    <th>Latitude</th>
                    <th>Longitude</th>

                    <th>Lokasi Maps</th>

                    <th>Created At</th>
                    <th>Updated At</th>

                </tr>

            </thead>

            <tbody>

                @forelse($absensis as $row)

                <tr>

                    <td>{{ $no++ }}</td>

                    <td>{{ $row->user_id ?? '-' }}</td>

                    <td>{{ $row->nama_pemantau ?? '-' }}</td>

                    <td>{{ $row->jenis_tutorial ?? '-' }}</td>

                    <td>{{ $row->tanggal ?? '-' }}</td>

                    <td>{{ $row->jam_tutorial ?? '-' }}</td>

                    <td>{{ $row->pertemuan_ke ?? '-' }}</td>

                    <td>
                        {{ $row->kode_nama_matkul_kelas ?? '-' }}
                    </td>

                    <td>
                        {{ $row->id_kelas_tutorial ?? '-' }}
                    </td>

                    <td>
                        {{ $row->id_tutor ?? '-' }}
                    </td>

                    <td>
                        {{ $row->nama_tutor ?? '-' }}
                    </td>

                    <td>
                        {{ $row->tgl_jam_mulai_pantau ?? '-' }}
                    </td>

                    <td>
                        {{ $row->jml_mhs_hadir ?? '-' }}
                    </td>

                    <td>
                        {{ $row->jml_mhs_seharusnya ?? '-' }}
                    </td>

                    <td>
                        {{ $row->jenis_pemantauan ?? '-' }}
                    </td>

                    <td>
                        {{ $row->kbm_absensi ?? '-' }}
                    </td>

                    <td>
                        {{ $row->kbm_materi ?? '-' }}
                    </td>

                    <td>
                        {{ $row->kbm_media ?? '-' }}
                    </td>

                    <td>
                        {{ $row->kbm_diskusi ?? '-' }}
                    </td>

                    <td>
                        {{ $row->kbm_pengarahan ?? '-' }}
                    </td>

                    <td>
                        {{ $row->bahas_tugas ?? '-' }}
                    </td>

                    <td>
                        {{ $row->jam_akhir_pantau ?? '-' }}
                    </td>

                    <td style="min-width:200px;">
                        {{ $row->praktik_baik ?? '-' }}
                    </td>

                    <td style="min-width:200px;">
                        {{ $row->temuan_ketidaksesuaian ?? '-' }}
                    </td>

                    <td style="min-width:200px;">
                        {{ $row->kesan_pembelajaran ?? '-' }}
                    </td>

                    <td style="min-width:200px;">
                        {{ $row->kendala_tutorial ?? '-' }}
                    </td>

                    <td style="min-width:200px;">
                        {{ $row->saran_perbaikan ?? '-' }}
                    </td>

                    <td>

                        @if($row->file_materi)

                        <a href="{{ $row->file_materi }}"
                           target="_blank">

                            Lihat File

                        </a>

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        @if($row->file_peserta)

                        <a href="{{ $row->file_peserta }}"
                           target="_blank">

                            Lihat File

                        </a>

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        @if($row->link_video)

                        <a href="{{ $row->link_video }}"
                           target="_blank">

                            Buka Video

                        </a>

                        @else

                        -

                        @endif

                    </td>

                    <td>
                        {{ $row->latitude ?? '-' }}
                    </td>

                    <td>
                        {{ $row->longitude ?? '-' }}
                    </td>

                    <td>

                        @if($row->latitude && $row->longitude)

                        <a href="https://www.google.com/maps?q={{ $row->latitude }},{{ $row->longitude }}"
                           target="_blank">

                            Google Maps

                        </a>

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        @if($row->created_at)

                            {{ $row->created_at->format('d-m-Y H:i:s') }}

                        @else

                            -

                        @endif

                    </td>

                    <td>

                        @if($row->updated_at)

                            {{ $row->updated_at->format('d-m-Y H:i:s') }}

                        @else

                            -

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="35" class="text-center py-4">
                        Belum ada data absensi
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div style="padding:15px;">
            <strong>Total:</strong>
            {{ $total }} record
        </div>

    </div>

</div>