@extends('template.modern')

@section('title', 'Instrumen Pemantauan TTM/TUWEB UT Jakarta Semester 2025 Genap')

@section('custom_style')
    <style>
        .form-section {
            border-top: 10px solid #006191;
            /* Sesuai warna primary template */
        }
    </style>
@endsection

@section('content')
    <main class="mt-24 pb-20 min-h-[calc(100vh-200px)] flex flex-col items-center px-4 md:px-6 relative overflow-hidden">
        <!-- Decorative background -->
        <div class="absolute top-10 right-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-10 left-10 w-64 h-64 bg-secondary/5 rounded-full blur-3xl -z-10"></div>

        <div class="w-full max-w-3xl">

            <!-- Header -->
            <div
                class="bg-surface-container-lowest form-section rounded-2xl shadow-lg border border-outline-variant/10 p-8 mb-8 relative overflow-hidden">
                <h1 class="text-3xl font-extrabold font-headline text-primary mb-4">Instrumen Pemantauan TTM/TUWEB UT
                    Jakarta Semester 2025 Genap</h1>
                <p class="text-on-surface-variant text-sm md:text-base mb-4 leading-relaxed">
                    Instrumen Pemantauan TTM/TUWEB Semester 2025 Genap ini disusun sebagai media evaluasi dan monitoring
                    pelaksanaan Tutorial Tatap Muka (TTM) serta Tutorial Webinar (TUWEB) agar kegiatan pembelajaran dapat
                    berjalan lebih efektif, interaktif, dan sesuai dengan kebutuhan mahasiswa.<br><br>
                    Mohon isi instrumen dengan jujur, lengkap, dan sesuai kondisi yang dialami selama mengikuti
                    tutorial.<br>
                    Terima kasih atas partisipasi dan kontribusinya.
                </p>
                <div class="mt-4 pt-4 border-t border-outline-variant/20 flex items-center justify-between">
                    <p class="text-sm text-on-surface">Akun: <strong>{{ auth()->user()->name }}</strong></p>
                </div>
                <p class="text-xs text-error mt-3">* Menunjukkan pertanyaan yang wajib diisi</p>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                    <p class="font-bold">Ada kesalahan:</p>
                    <ul class="list-disc pl-5 text-sm mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" id="absensiForm">
                @csrf
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <!-- Notifikasi GPS -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 shadow-sm mb-6 transition-all duration-300"
                    id="gpsStatusCard">
                    <div class="flex items-start">
                        <svg class="animate-spin -ml-1 mr-4 h-6 w-6 text-yellow-600 mt-1 flex-shrink-0"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" id="gpsSpinner">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <div>
                            <h3 class="text-yellow-800 font-bold text-lg mb-1" id="gpsTitle">Mendeteksi Lokasi GPS...</h3>
                            <p class="text-yellow-700 text-sm" id="gpsDesc">Mohon izinkan akses lokasi (Location/GPS) di
                                browser Anda agar bisa submit form ini.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Silahkan pilih nama Bapak/Ibu
                            <span class="text-error">*</span></label>
                        <input type="text" value="{{ auth()->user()->name }}" readonly
                            class="w-full border-b-2 border-outline-variant/50 bg-surface-container-low py-2 px-3 text-on-surface-variant cursor-not-allowed rounded-t-md">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-3 font-headline">Jenis Tutorial <span
                                class="text-error">*</span></label>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="radio" name="jenis_tutorial" value="TTM" required
                                    class="form-radio h-5 w-5 text-primary border-outline focus:ring-primary">
                                <span class="text-on-surface group-hover:text-primary transition-colors">TTM</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="radio" name="jenis_tutorial" value="Tuweb" required
                                    class="form-radio h-5 w-5 text-primary border-outline focus:ring-primary">
                                <span class="text-on-surface group-hover:text-primary transition-colors">Tuweb</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Hari dan Tanggal <span
                                class="text-error">*</span></label>
                        <input type="date" name="tanggal" required
                            class="w-full sm:w-1/2 border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary px-4 py-2 bg-transparent text-on-surface">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Jam tutorial <span
                                class="text-error">*</span></label>
                        <select name="jam_tutorial" required
                            class="w-full sm:w-1/2 border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary px-4 py-2 bg-transparent text-on-surface">
                            <option value="">Choose</option>
                            <option value="08.00-10.00 WIB">08.00-10.00 WIB</option>
                            <option value="10.15-12.15 WIB">10.15-12.15 WIB</option>
                            <option value="13.00-15.00 WIB">13.00-15.00 WIB</option>
                            <option value="15.15-17.15 WIB">15.15-17.15 WIB</option>
                        </select>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Pertemuan ke- <span
                                class="text-error">*</span></label>
                        <select name="pertemuan_ke" required
                            class="w-full sm:w-1/2 border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary px-4 py-2 bg-transparent text-on-surface">
                            <option value="">Pilih pertemuan...</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">Pertemuan ke-{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Kode / Nama Mata Kuliah / Nama
                            Kelas: <span class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Tuliskan kode mata kuliah, nama mata kuliah, dan nama kelas.
                            Contoh: EACC4101/Pengantar Akuntansi/EACC4101.210005</p>
                        <input type="text" name="kode_nama_matkul_kelas" required
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface placeholder-outline-variant">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">ID Kelas Tutorial: <span
                                class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Tuliskan ID Kelas Tutorial sesuai data pemantauan (6 digit).
                            Contoh: 210002341</p>
                        <input type="text" name="id_kelas_tutorial" required
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface placeholder-outline-variant">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">ID Tutor: <span
                                class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Tuliskan ID Tutor sesuai data pemantauan (8 digit). Contoh:
                            21501602</p>
                        <input type="text" name="id_tutor" required
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface placeholder-outline-variant">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Nama Tutor: <span
                                class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Tuliskan Nama Tutor sesuai daftar penjadwalan & ijin kelas!
                            Contoh: AHMAD TRY HANDOKO, SE., M.AK.</p>
                        <input type="text" name="nama_tutor" required
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface placeholder-outline-variant">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Tanggal dan Jam MULAI Pemantauan
                            TTM/Tuweb melalui Ms. Teams* <span class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Isikan tanggal, jam, dan menit saat Anda memulai pemantauan
                            TTM/Tuweb melalui Ms. Teams! Contoh: 11/04/2022 pukul 08.00 WIB</p>
                        <input type="text" name="tgl_jam_mulai_pantau" required
                            placeholder="Contoh: 11/04/2022 pukul 08.00 WIB"
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Jumlah mahasiswa yang seharusnya
                            hadir di kelas yang dipantau: <span class="text-error">*</span></label>
                        <input type="number" name="jml_mhs_seharusnya" required
                            class="w-full sm:w-1/3 border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Jumlah mahasiswa yang hadir di
                            kelas yang dipantau: <span class="text-error">*</span></label>
                        <input type="number" name="jml_mhs_hadir" required
                            class="w-full sm:w-1/3 border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-3 font-headline">Jenis Pemantauan untuk Kelompok
                            Matakuliah: <span class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">
                            1 = NON Praktik/Praktikum<br>
                            2 = Praktik/Praktikum/Berpraktik
                        </p>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="radio" name="jenis_pemantauan" value="NON Praktik/Praktikum" required
                                    class="form-radio h-5 w-5 text-primary border-outline focus:ring-primary">
                                <span class="text-on-surface group-hover:text-primary transition-colors">NON
                                    Praktik/Praktikum</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="radio" name="jenis_pemantauan" value="Praktik/Praktikum/Berpraktik" required
                                    class="form-radio h-5 w-5 text-primary border-outline focus:ring-primary">
                                <span
                                    class="text-on-surface group-hover:text-primary transition-colors">Praktik/Praktikum/Berpraktik</span>
                            </label>
                        </div>
                    </div>

                    <!-- Proses KBM -->
                    <div
                        class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 overflow-x-auto">
                        <label class="block font-bold text-on-surface mb-4 font-headline">Proses Kegiatan Belajar Mengajar
                            (KBM) <span class="text-error">*</span></label>
                        <table class="w-full text-left text-sm min-w-[600px]">
                            <thead>
                                <tr class="border-b border-outline-variant/30">
                                    <th class="pb-3 font-semibold text-on-surface-variant w-3/4">Pertanyaan</th>
                                    <th class="pb-3 text-center font-semibold text-on-surface-variant w-1/8">Ya</th>
                                    <th class="pb-3 text-center font-semibold text-on-surface-variant w-1/8">Tidak</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/20">
                                @php
                                    $kbmOptions = [
                                        'kbm_absensi' => '1. Tutor melakukan absensi kepada mahasiswa',
                                        'kbm_materi' => '2. Di awal pembelajaran, tutor menyampaikan materi yang akan dibahas',
                                        'kbm_media' => '3. Tutor menggunakan media (PowerPoint, Word, dll.)',
                                        'kbm_diskusi' => '4. Tutor berdiskusi dengan mahasiswa secara aktif',
                                        'kbm_pengarahan' => '5. Di akhir pembelajaran, tutor memberikan pengarahan tentang sesi tutorial yang akan datang'
                                    ];
                                @endphp
                                @foreach($kbmOptions as $name => $label)
                                    <tr class="hover:bg-surface-container-low transition-colors">
                                        <td class="py-4 pr-4 text-on-surface whitespace-normal">{{ $label }}</td>
                                        <td class="py-4 text-center">
                                            <input type="radio" name="{{ $name }}" value="Ya" required
                                                class="form-radio h-5 w-5 text-primary border-outline focus:ring-primary">
                                        </td>
                                        <td class="py-4 text-center">
                                            <input type="radio" name="{{ $name }}" value="Tidak" required
                                                class="form-radio h-5 w-5 text-primary border-outline focus:ring-primary">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Tutor Membahas Tugas Tutorial yang
                            diberikan pada Pertemuan Sebelumnya</label>
                        <p class="text-sm text-outline mb-3">(Jika pemantauan dilakukan pada minggu ke 4, 6, atau 8 untuk MK
                            Non Praktik)</p>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="radio" name="bahas_tugas" value="Ya"
                                    class="form-radio h-5 w-5 text-primary border-outline focus:ring-primary">
                                <span class="text-on-surface group-hover:text-primary transition-colors">Ya</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="radio" name="bahas_tugas" value="Tidak"
                                    class="form-radio h-5 w-5 text-primary border-outline focus:ring-primary">
                                <span class="text-on-surface group-hover:text-primary transition-colors">Tidak</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Jam AKHIR Pemantauan TTM/Tuweb
                            melalui Ms. Teams <span class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Isikan jam dan menit saat Anda mengakhiri pemantauan TTM/Tuweb
                            melalui Ms. Teams! Contoh: pukul 12.00 WIB</p>
                        <input type="text" name="jam_akhir_pantau" required
                            class="w-full sm:w-1/2 border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface">
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">PRAKTIK BAIK: <span
                                class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Tuliskan dengan rinci praktik baik dalam tuweb atau
                            praktik/praktikum termasuk hari/tanggal, jam, tutor, mata kuliah yang dipantau sesuai indikator
                            pelaksanaan pada laporan pemantauan.</p>
                        <textarea name="praktik_baik" required rows="4"
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface resize-y"></textarea>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">TEMUAN KETIDAKSESUAIAN: <span
                                class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Tuliskan dengan rinci temuan ketidaksesuaian dalam tuweb atau
                            praktik/praktikum termasuk hari/tanggal, jam, tutor, mata kuliah yang dipantau sesuai indikator
                            pelaksanaan pada laporan pemantauan.</p>
                        <textarea name="temuan_ketidaksesuaian" required rows="4"
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface resize-y"></textarea>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Kesan Terhadap Proses Pembelajaran
                            pada Pertemuan TTM/Tuweb melalui Ms. Teams <span class="text-error">*</span></label>
                        <textarea name="kesan_pembelajaran" required rows="3"
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface resize-y"></textarea>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Kendala yang Dihadapi Tutor dan
                            Mahasiswa Selama Proses Pertemuan TTM/Tuweb melalui Ms. Teams Berlangsung <span
                                class="text-error">*</span></label>
                        <textarea name="kendala_tutorial" required rows="3"
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface resize-y"></textarea>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Saran Perbaikan Pelaksanaan
                            TTM/Tuweb melalui Ms. Teams <span class="text-error">*</span></label>
                        <textarea name="saran_perbaikan" required rows="3"
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface resize-y"></textarea>
                    </div>

                    <!-- File Uploads -->
                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-3 font-headline">Screenshot/Foto pada Saat Tutor
                            Sedang Menyampaikan Materi <span class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">File yang diperbolehkan yaitu gambar dalam format *.JPG,
                            *.JPEG, *.BMP, *.PNG maksimal 10 MB</p>
                        <div
                            class="mt-2 border-2 border-dashed border-outline-variant/60 rounded-xl p-8 flex flex-col items-center justify-center bg-surface-container-lowest hover:bg-surface-container-low transition-colors cursor-pointer relative">
                            <span class="material-symbols-outlined text-4xl text-outline mb-3">cloud_upload</span>
                            <p class="text-sm text-on-surface-variant font-medium mb-1 file-name">Tambahkan file</p>
                            <input type="file" name="file_materi" required accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-3 font-headline">Screenshot/Foto yang Memuat
                            Seluruh Peserta/Partisipan dalam Pertemuan TTM/Tuweb melalui Ms. Teams <span
                                class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">File yang diperbolehkan yaitu gambar dalam format *.JPG,
                            *.JPEG, *.BMP, *.PNG maksimal 10 MB</p>
                        <div
                            class="mt-2 border-2 border-dashed border-outline-variant/60 rounded-xl p-8 flex flex-col items-center justify-center bg-surface-container-lowest hover:bg-surface-container-low transition-colors cursor-pointer relative">
                            <span class="material-symbols-outlined text-4xl text-outline mb-3">cloud_upload</span>
                            <p class="text-sm text-on-surface-variant font-medium mb-1 file-name">Tambahkan file</p>
                            <input type="file" name="file_peserta" required accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <label class="block font-bold text-on-surface mb-2 font-headline">Cuplikan Video Rekaman Saat
                            Pemantauan <span class="text-error">*</span></label>
                        <p class="text-sm text-outline mb-3">Silahkan upload video pada drive masing-masing kemudian isikan
                            link pada kolom dibawah (jangan lupa untuk membuka akses untuk semua orang)</p>
                        <input type="url" name="link_video" required placeholder="https://..."
                            class="w-full border-b-2 border-outline-variant/50 focus:border-primary focus:outline-none py-2 bg-transparent text-on-surface placeholder-outline-variant">
                    </div>

                </div>

                <div class="mt-10 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <button type="submit" id="submitBtn" disabled
                        class="w-full sm:w-auto bg-outline-variant text-white font-bold py-4 px-10 rounded-xl cursor-not-allowed transition-all shadow-md flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">send</span>
                        Kirim
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-xs text-outline">Jangan pernah mengirimkan sandi melalui Google Formulir.</p>
                </div>

            </form>
        </div>
    </main>
@endsection

@section('custom_script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const submitBtn = document.getElementById('submitBtn');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            const gpsStatusCard = document.getElementById('gpsStatusCard');
            const gpsTitle = document.getElementById('gpsTitle');
            const gpsDesc = document.getElementById('gpsDesc');
            const gpsSpinner = document.getElementById('gpsSpinner');

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        latitudeInput.value = position.coords.latitude;
                        longitudeInput.value = position.coords.longitude;

                        gpsStatusCard.classList.remove('bg-yellow-50', 'border-yellow-200');
                        gpsStatusCard.classList.add('bg-green-50', 'border-green-200');

                        gpsTitle.textContent = "Lokasi Berhasil Ditemukan!";
                        gpsTitle.classList.remove('text-yellow-800');
                        gpsTitle.classList.add('text-green-800');

                        gpsDesc.textContent = "Koordinat GPS telah tersimpan otomatis.";
                        gpsDesc.classList.remove('text-yellow-700');
                        gpsDesc.classList.add('text-green-700');

                        gpsSpinner.style.display = 'none';

                        submitBtn.disabled = false;
                        submitBtn.classList.remove('bg-outline-variant', 'cursor-not-allowed');
                        submitBtn.classList.add('bg-primary', 'hover:bg-sky-800', 'active:scale-[0.98]');
                    },
                    function (error) {
                        gpsStatusCard.classList.remove('bg-yellow-50', 'border-yellow-200');
                        gpsStatusCard.classList.add('bg-red-50', 'border-red-200');

                        gpsTitle.textContent = "Gagal Mendapatkan Lokasi";
                        gpsTitle.classList.remove('text-yellow-800');
                        gpsTitle.classList.add('text-red-800');

                        gpsDesc.textContent = "Mohon pastikan GPS aktif dan Anda mengizinkan akses lokasi. Refresh halaman untuk mencoba lagi.";
                        gpsDesc.classList.remove('text-yellow-700');
                        gpsDesc.classList.add('text-red-700');

                        gpsSpinner.style.display = 'none';
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                gpsTitle.textContent = "Browser Tidak Mendukung GPS";
                gpsDesc.textContent = "Gunakan browser modern di HP/Laptop Anda.";
                gpsSpinner.style.display = 'none';
            }

            // Visual feedback when files are selected
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        const parent = this.parentElement;
                        parent.classList.add('border-primary', 'bg-primary/5');
                        const textEl = parent.querySelector('p.file-name');
                        if (textEl) {
                            textEl.textContent = this.files[0].name;
                            textEl.classList.add('text-primary');
                        }
                    }
                });
            });
        });
    </script>
@endsection