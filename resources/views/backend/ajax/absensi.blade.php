<div class="data-card">

    <div class="data-card-header">
        <h3>Data Absensi Pegawai (Monitoring)</h3>
    </div>

    <div class="data-card-body" style="overflow-x:auto;">

        @php
        try {
            $absensis = \App\Models\AbsensiPegawai::latest()->limit(50)->get();
            $total = \App\Models\AbsensiPegawai::count();
        } catch (\Exception $e) {
            $absensis = [];
            $total = 0;
        }

        $no = 1;
        @endphp

        <table class="table table-bordered table-striped" style="width:100%; min-width:1400px;">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemantau</th>
                    <th>Tanggal</th>
                    <th>Jenis Tutorial</th>
                    <th>Nama Tutor</th>
                    <th>Mata Kuliah</th>
                    <th>Kehadiran</th>
                    <th>Lokasi GPS</th>
                    <th>File Materi</th>
                    <th>File Peserta</th>
                    <th>Video</th>
                    <th>Waktu Submit</th>
                </tr>
            </thead>

            <tbody>

                @forelse($absensis as $row)

                <tr>

                    <td>{{ $no++ }}</td>

                    <td>
                        {{ $row->nama_pemantau ?? '-' }}
                    </td>

                    <td>
                        {{ $row->tanggal ?? '-' }}
                    </td>

                    <td>
                        {{ $row->jenis_tutorial ?? '-' }}
                    </td>

                    <td>
                        <strong>{{ $row->nama_tutor ?? '-' }}</strong>
                        <br>
                        <small>ID: {{ $row->id_tutor ?? '-' }}</small>
                    </td>

                    <td>
                        {{ $row->kode_nama_matkul_kelas ?? '-' }}
                        <br>
                        <small>
                            Kelas:
                            {{ $row->id_kelas_tutorial ?? '-' }}
                        </small>
                    </td>

                    <td>
                        {{ $row->jml_mhs_hadir ?? 0 }}
                        /
                        {{ $row->jml_mhs_seharusnya ?? 0 }}
                    </td>

                    <td>

                        @if($row->latitude && $row->longitude)

                        <a href="https://www.google.com/maps?q={{ $row->latitude }},{{ $row->longitude }}"
                           target="_blank">

                            Lihat Lokasi

                        </a>

                        @else

                        -

                        @endif

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

                        @if($row->created_at)

                            {{ $row->created_at->format('d M Y') }}

                            <br>

                            <small>
                                {{ $row->created_at->format('H:i:s') }}
                            </small>

                        @else

                            -

                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="12" class="text-center py-4">
                        Belum ada data absensi
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

        <div style="padding: 15px;">
            <p>
                <strong>Total:</strong>
                {{ $total }} record
            </p>
        </div>

    </div>

</div>