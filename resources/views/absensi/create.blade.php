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
    <main
        class="mt-24 pb-20 min-h-[calc(100vh-200px)] flex flex-col items-center px-4 md:px-6 relative overflow-hidden bg-[#f7f9ff]">
        <!-- Decorative background -->
        <div class="absolute top-10 right-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-10 left-10 w-64 h-64 bg-secondary/5 rounded-full blur-3xl -z-10"></div>

        <div class="w-full max-w-[1100px]">

            <!-- Header Banner -->
            <div class="bg-[#006191] rounded-2xl p-8 md:p-12 mb-8 relative overflow-hidden text-white shadow-lg">
                <!-- optional background image/pattern -->
                <div class="absolute right-0 bottom-0 opacity-20 pointer-events-none">
                    <!-- Placeholder for background image if needed -->
                </div>
                <div class="relative z-10 max-w-3xl">
                    <h1 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight font-headline">Instrumen
                        Pemantauan<br>TTM/TUWEB UT Jakarta</h1>
                    <p class="text-blue-100 text-sm md:text-base leading-relaxed max-w-2xl">
                        Formulir evaluasi dan pelaporan resmi untuk kegiatan Tutorial Tatap Muka (TTM) dan Tutorial Webinar
                        (TUWEB) Universitas Terbuka Jakarta. Semester 2025 Genap.
                    </p>
                    <div
                        class="mt-6 inline-flex items-center bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm border border-white/20">
                        <span class="material-symbols-outlined text-yellow-400 mr-2">account_circle</span>
                        <p class="text-sm">Pemantau: <strong>Tamu</strong></p>
                    </div>
                </div>
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

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                    <!-- Kiri: Col-Span 4 -->
                    <div class="lg:col-span-4 space-y-6">

                        <!-- Card Identitas Pemantau -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                            <div class="flex items-center mb-6">
                                <div class="w-1.5 h-6 bg-yellow-400 rounded-full mr-3"></div>
                                <h2 class="text-xl font-bold text-[#006191] font-headline">Identitas Pemantau</h2>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Nama
                                        Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_pemantau" required placeholder="Masukkan Nama Lengkap"
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 placeholder-gray-400">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Jenis
                                        Tutorial <span class="text-red-500">*</span></label>
                                    <select name="jenis_tutorial" required
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 appearance-none">
                                        <option value="">Pilih Jenis</option>
                                        <option value="TTM">TTM</option>
                                        <option value="Tuweb">Tuweb</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Jenis
                                        Pemantauan Kelompok <span class="text-red-500">*</span></label>
                                    <select name="jenis_pemantauan" required
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 appearance-none">
                                        <option value="">Pilih Jenis Pemantauan</option>
                                        <option value="NON Praktik/Praktikum">NON Praktik/Praktikum</option>
                                        <option value="Praktik/Praktikum/Berpraktik">Praktik/Praktikum/Berpraktik</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Card Jadwal & Mata Kuliah -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                            <div class="flex items-center mb-6">
                                <div class="w-1.5 h-6 bg-yellow-400 rounded-full mr-3"></div>
                                <h2 class="text-xl font-bold text-[#006191] font-headline">Jadwal & Mata Kuliah</h2>
                            </div>

                            <div class="space-y-5">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Tanggal
                                            <span class="text-red-500">*</span></label>
                                        <input type="date" name="tanggal" required
                                            class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Waktu
                                            (WIB) <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <select name="jam_tutorial" required
                                                class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 appearance-none pr-10">
                                                <option value="">--:-- --</option>
                                                <option value="08.00-10.00 WIB">08.00-10.00 WIB</option>
                                                <option value="10.15-12.15 WIB">10.15-12.15 WIB</option>
                                                <option value="13.00-15.00 WIB">13.00-15.00 WIB</option>
                                                <option value="15.15-17.15 WIB">15.15-17.15 WIB</option>
                                            </select>
                                            <span
                                                class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none text-xl">schedule</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Pertemuan
                                        Ke- <span class="text-red-500">*</span></label>
                                    <select name="pertemuan_ke" required
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 appearance-none">
                                        <option value="">Pilih pertemuan...</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}">Pertemuan ke-{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Kode /
                                        Nama Matkul <span class="text-red-500">*</span></label>
                                    <input type="text" name="kode_nama_matkul_kelas" required
                                        placeholder="Contoh: Pengantar Ilmu Hukum"
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 placeholder-gray-400">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">ID
                                        Kelas Tutorial <span class="text-red-500">*</span></label>
                                    <input type="text" name="id_kelas_tutorial" required placeholder="Contoh: 210002341"
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 placeholder-gray-400">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">ID &
                                        Nama Tutor <span class="text-red-500">*</span></label>
                                    <div class="grid grid-cols-1 gap-2">
                                        <input type="text" name="id_tutor" required placeholder="ID Tutor (ex: 21501602)"
                                            class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 placeholder-gray-400">
                                        <input type="text" name="nama_tutor" required placeholder="Nama Tutor"
                                            class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 placeholder-gray-400">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Col-Span 8 -->
                    <div class="lg:col-span-8 space-y-6">

                        <!-- Card Evaluasi Proses KBM -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                            <div class="flex items-center mb-6">
                                <div class="w-1.5 h-6 bg-yellow-400 rounded-full mr-3"></div>
                                <h2 class="text-xl font-bold text-[#006191] font-headline">Evaluasi Proses KBM</h2>
                            </div>

                            <!-- Kehadiran & Waktu -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div class="bg-[#f8fafc] p-5 rounded-xl border border-gray-100">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">Waktu
                                        Pemantauan (Ms. Teams) <span class="text-red-500">*</span></label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <span class="text-[10px] text-gray-400 uppercase tracking-wider block mb-1">Jam
                                                Mulai</span>
                                            <input type="text" name="tgl_jam_mulai_pantau" required
                                                placeholder="ex: 08.00 WIB"
                                                class="w-full bg-white border border-gray-200 text-gray-800 rounded-lg py-2 px-3 text-sm focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow">
                                        </div>
                                        <div>
                                            <span class="text-[10px] text-gray-400 uppercase tracking-wider block mb-1">Jam
                                                Selesai</span>
                                            <input type="text" name="jam_akhir_pantau" required placeholder="ex: 10.00 WIB"
                                                class="w-full bg-white border border-gray-200 text-gray-800 rounded-lg py-2 px-3 text-sm focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-[#f8fafc] p-5 rounded-xl border border-gray-100">
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">Kehadiran
                                        Mahasiswa <span class="text-red-500">*</span></label>
                                    <div class="flex items-center gap-3 mt-5">
                                        <div class="w-full relative">
                                            <input type="number" name="jml_mhs_hadir" required placeholder="Hadir"
                                                class="w-full bg-white border border-gray-200 text-gray-800 rounded-lg py-2 pl-3 pr-8 text-sm focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow">
                                            <span class="absolute right-3 top-2 text-xs text-gray-400">org</span>
                                        </div>
                                        <span class="text-gray-300 font-light text-2xl">/</span>
                                        <div class="w-full relative">
                                            <input type="number" name="jml_mhs_seharusnya" required placeholder="Seharusnya"
                                                class="w-full bg-white border border-gray-200 text-gray-800 rounded-lg py-2 pl-3 pr-8 text-sm focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow">
                                            <span class="absolute right-3 top-2 text-xs text-gray-400">org</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- KBM Table -->
                            <div class="mb-8">
                                <div class="flex items-center justify-between px-4 pb-3 border-b border-gray-200">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Aspek
                                        Pengamatan <span class="text-red-500">*</span></label>
                                    <div class="flex gap-8 pr-4">
                                        <span class="text-xs font-bold text-gray-500 uppercase w-12 text-center">Ya</span>
                                        <span
                                            class="text-xs font-bold text-gray-500 uppercase w-12 text-center">Tidak</span>
                                    </div>
                                </div>
                                <div class="space-y-2 mt-4">
                                    @php
                                        $kbmOptions = [
                                            'kbm_absensi' => '1. Tutor hadir tepat waktu sesuai jadwal & melakukan absensi',
                                            'kbm_materi' => '2. Di awal pembelajaran, tutor menyampaikan materi yang akan dibahas',
                                            'kbm_media' => '3. Tutor menggunakan media pembelajaran (PowerPoint, Word, dll.)',
                                            'kbm_diskusi' => '4. Mahasiswa aktif dalam diskusi dan tanya jawab dengan tutor',
                                            'kbm_pengarahan' => '5. Di akhir pembelajaran, tutor memberikan pengarahan sesi mendatang'
                                        ];
                                    @endphp
                                    @foreach($kbmOptions as $name => $label)
                                        <div
                                            class="flex items-center justify-between bg-[#f8fafc] p-4 rounded-xl hover:bg-[#f0f4fa] transition-colors border border-transparent hover:border-gray-100">
                                            <span
                                                class="text-sm text-gray-700 font-medium pr-4 leading-relaxed">{{ $label }}</span>
                                            <div class="flex gap-8 pr-6">
                                                <label class="cursor-pointer w-8 text-center flex justify-center group">
                                                    <input type="radio" name="{{ $name }}" value="Ya" required
                                                        class="w-5 h-5 text-[#006191] focus:ring-[#006191] border-gray-300">
                                                </label>
                                                <label class="cursor-pointer w-8 text-center flex justify-center group">
                                                    <input type="radio" name="{{ $name }}" value="Tidak" required
                                                        class="w-5 h-5 text-[#006191] focus:ring-[#006191] border-gray-300">
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div
                                        class="flex items-center justify-between bg-[#f8fafc] p-4 rounded-xl hover:bg-[#f0f4fa] transition-colors border border-transparent hover:border-gray-100">
                                        <span class="text-sm text-gray-700 font-medium pr-4 leading-relaxed">6. Tutor
                                            membahas tugas pertemuan sebelumnya (khusus minggu 4, 6, 8)</span>
                                        <div class="flex gap-8 pr-6">
                                            <label class="cursor-pointer w-8 text-center flex justify-center">
                                                <input type="radio" name="bahas_tugas" value="Ya"
                                                    class="w-5 h-5 text-[#006191] focus:ring-[#006191] border-gray-300">
                                            </label>
                                            <label class="cursor-pointer w-8 text-center flex justify-center">
                                                <input type="radio" name="bahas_tugas" value="Tidak"
                                                    class="w-5 h-5 text-[#006191] focus:ring-[#006191] border-gray-300">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Text Areas -->
                            <div class="space-y-5">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Catatan /
                                        Praktik Baik <span class="text-red-500">*</span></label>
                                    <textarea name="praktik_baik" required rows="2"
                                        placeholder="Tuliskan praktik baik dalam tuweb..."
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow resize-y"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Temuan
                                        Ketidaksesuaian <span class="text-red-500">*</span></label>
                                    <textarea name="temuan_ketidaksesuaian" required rows="2"
                                        placeholder="Tuliskan temuan ketidaksesuaian..."
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow resize-y"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Kesan
                                        Terhadap Pembelajaran <span class="text-red-500">*</span></label>
                                    <textarea name="kesan_pembelajaran" required rows="2"
                                        placeholder="Tuliskan kesan anda..."
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow resize-y"></textarea>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Kendala
                                        Tutorial <span class="text-red-500">*</span></label>
                                    <textarea name="kendala_tutorial" required rows="2"
                                        placeholder="Tuliskan kendala yang dihadapi..."
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow resize-y"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Saran
                                        Perbaikan <span class="text-red-500">*</span></label>
                                    <textarea name="saran_perbaikan" required rows="2"
                                        placeholder="Tuliskan saran perbaikan..."
                                        class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow resize-y"></textarea>
                                </div>
                            </div>

                        </div>

                        <!-- Card Bukti Dokumentasi -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                            <div class="flex items-center mb-6">
                                <div class="w-1.5 h-6 bg-yellow-400 rounded-full mr-3"></div>
                                <h2 class="text-xl font-bold text-[#006191] font-headline">Bukti Dokumentasi</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                                <!-- Uploads -->
                                <div class="space-y-5">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Screenshot
                                            Pertemuan (Materi) <span class="text-red-500">*</span></label>
                                        <div
                                            class="border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center bg-[#f8fafc] hover:bg-[#f0f4fa] hover:border-[#006191]/50 transition-colors cursor-pointer relative group">
                                            <span
                                                class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-[#006191] mb-2 transition-colors">upload_file</span>
                                            <p class="text-sm text-gray-600 font-medium text-center file-name">Klik untuk
                                                unggah gambar</p>
                                            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider">PNG, JPG up
                                                to 10MB</p>
                                            <input type="file" name="file_materi" required accept="image/*"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        </div>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Screenshot
                                            Pertemuan (Peserta) <span class="text-red-500">*</span></label>
                                        <div
                                            class="border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center bg-[#f8fafc] hover:bg-[#f0f4fa] hover:border-[#006191]/50 transition-colors cursor-pointer relative group">
                                            <span
                                                class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-[#006191] mb-2 transition-colors">upload_file</span>
                                            <p class="text-sm text-gray-600 font-medium text-center file-name">Klik untuk
                                                unggah gambar</p>
                                            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider">PNG, JPG up
                                                to 10MB</p>
                                            <input type="file" name="file_peserta" required accept="image/*"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        </div>
                                    </div>
                                </div>

                                <!-- Link & Submit -->
                                <div class="flex flex-col h-full space-y-6">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Link
                                            Rekaman (Video) <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span
                                                    class="material-symbols-outlined text-gray-400 text-[20px]">link</span>
                                            </div>
                                            <input type="url" name="link_video" required
                                                placeholder="https://youtube.com/..."
                                                class="w-full bg-[#f0f4fa] border-none text-gray-800 rounded-lg py-3 pl-10 pr-4 focus:ring-2 focus:ring-[#006191]/20 outline-none transition-shadow">
                                        </div>
                                    </div>

                                    <div class="mt-auto pt-4 flex-grow flex flex-col justify-end">
                                        <button type="submit" id="submitBtn" disabled
                                            class="w-full bg-[#006191] hover:bg-[#004b71] disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed text-white font-bold py-4 px-6 rounded-xl transition-colors shadow-md flex items-center justify-center gap-2 group">
                                            <span
                                                class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">send</span>
                                            Kirim Laporan Monitoring
                                        </button>
                                        <p class="text-[9px] text-gray-400 text-center mt-3 uppercase tracking-wider">
                                            Pastikan data yang diisi telah sesuai dengan keadaan lapangan</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
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
                        submitBtn.classList.remove('disabled:bg-gray-300', 'disabled:cursor-not-allowed');
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
                        parent.classList.add('border-[#006191]', 'bg-[#006191]/5');
                        parent.classList.remove('border-gray-300', 'bg-[#f8fafc]');
                        const textEl = parent.querySelector('p.file-name');
                        const iconEl = parent.querySelector('.material-symbols-outlined');
                        if (textEl) {
                            textEl.textContent = this.files[0].name;
                            textEl.classList.add('text-[#006191]');
                            textEl.classList.remove('text-gray-600');
                        }
                        if (iconEl) {
                            iconEl.classList.add('text-[#006191]');
                            iconEl.classList.remove('text-gray-400');
                        }
                    }
                });
            });
        });
    </script>
@endsection