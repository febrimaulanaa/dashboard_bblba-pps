<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UT Jakarta - Jadwal LPKBJJ</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface": "#181c20",
                        "on-primary-container": "#fcfcff",
                        "primary-container": "#007bb6",
                        "tertiary-container": "#5275ac",
                        "surface-container-low": "#f0f4fa",
                        "secondary": "#705d00",
                        "primary": "#006191",
                        "surface-container-lowest": "#ffffff",
                        "inverse-primary": "#8fcdff",
                        "tertiary-fixed-dim": "#a7c8ff",
                        "on-secondary-container": "#6e5c00",
                        "surface-container": "#eaeef4",
                        "on-secondary-fixed-variant": "#544600",
                        "surface": "#f7f9ff",
                        "primary-fixed": "#cbe6ff",
                        "on-error-container": "#93000a",
                        "tertiary": "#385d92",
                        "secondary-fixed": "#ffe16d",
                        "surface-variant": "#dfe3e9",
                        "secondary-fixed-dim": "#e9c400",
                        "on-primary": "#ffffff",
                        "outline": "#6f7881",
                        "error-container": "#ffdad6",
                        "surface-dim": "#d7dae0",
                        "inverse-on-surface": "#edf1f7",
                        "on-tertiary-container": "#fefcff",
                        "on-primary-fixed": "#001e30",
                        "on-tertiary-fixed": "#001b3c",
                        "on-secondary-fixed": "#221b00",
                        "surface-tint": "#006495",
                        "surface-bright": "#f7f9ff",
                        "surface-container-highest": "#dfe3e9",
                        "tertiary-fixed": "#d5e3ff",
                        "on-background": "#181c20",
                        "on-secondary": "#ffffff",
                        "background": "#f7f9ff",
                        "error": "#ba1a1a",
                        "primary-fixed-dim": "#8fcdff",
                        "on-tertiary": "#ffffff",
                        "surface-container-high": "#e5e8ee",
                        "inverse-surface": "#2c3135",
                        "secondary-container": "#fcd400",
                        "on-surface-variant": "#3f4850",
                        "outline-variant": "#bec7d2",
                        "on-primary-fixed-variant": "#004b71",
                        "on-tertiary-fixed-variant": "#1f477b",
                        "on-error": "#ffffff"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-nav {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        .hero-gradient {
            background: linear-gradient(135deg, #006191 0%, #007bb6 100%);
        }

        .academic-table th {
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            font-size: 0.75rem;
            color: #3f4850;
        }
    </style>
    @include('partials.analytics')
</head>

<body class="bg-surface font-body text-on-surface selection:bg-secondary-fixed selection:text-on-secondary-fixed">

    <!-- TopNavBar -->
    <nav
        class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-[0_12px_32px_rgba(24,28,32,0.04)]">
        <div class="flex items-center justify-between px-8 py-4 max-w-[1440px] mx-auto w-full">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                    <span class="material-symbols-outlined text-[#006191]">arrow_back</span>
                    <span class="text-sm font-bold text-[#006191] font-headline">Kembali</span>
                </a>
                <div
                    class="text-xl font-extrabold tracking-tighter text-[#006191] dark:text-sky-400 font-headline ml-4">
                    UT Jakarta
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 text-slate-600 hover:bg-slate-50 rounded-lg transition-all active:scale-95">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-surface-container ml-2">
                    <img alt="User Profile Avatar" class="w-full h-full object-cover"
                        src="{{ asset('assets/img/bruce-mars.jpg') }}"
                        onerror="this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuAsSBYsVmu7PGk7ggCE0RqMtlqnypcP9ohtdJ4Jt_aimQiSbGerZEzX3-7i5FT6g0DOLTPVfSkI_y7lNReDw_UwiOMJrmhOK2hO5imaAXnvJOhcEKD82znpzhV40CfaHfVFbTR_il7owqGQmjP8zvZPmEXalxlyrFi6iFBkdFKnyRBCgs41VfNHKoRb-gUQy_QW4sTNX-Z5vN_dqeFX__XdrvnxbCR7-ffTXGb9tE-Nye6ZVOyDHqJLaTQDQujQBcckoI0MZhNfjBUJ'" />
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-20">
        <!-- Hero Section -->
        <section class="relative h-[400px] flex items-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover opacity-20 filter grayscale" data-alt="University building"
                    src="{{ asset('assets/img/backut.png') }}"
                    onerror="this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuC-HePEwAkU7OQuu0DAbyluR9eXALCFc3tQ3z02DQ3I0MCehRMtO6-GrexNx15DOPmAT77_K8Qam80SVhq0HxaHvzBtyrE_dKKWfzyWm_XFIn2LLfDEdeBbKDcdwVLsGTUPEXI0tUeZBBLb6bqedPDrkY76cp_TX8dHjnRvdGTPX16zfQ04zhMVkCo1fGSGYjMAByt-0v4ATZiFTUd-hP28zU_SeX-2Rn7d9JQY9kbKwrX5PfoBhFztXOtEuqifyEeDk0H3Pye4rWv_'" />
                <div class="absolute inset-0 hero-gradient opacity-90"></div>
            </div>
            <div class="relative z-10 max-w-[1440px] mx-auto px-8 w-full text-on-primary">
                <p class="font-label text-sm uppercase tracking-[0.2em] mb-4 text-secondary-fixed font-bold">Portal
                    Akademik Terintegrasi</p>
                <h1
                    class="font-headline text-5xl md:text-6xl font-extrabold tracking-tight mb-6 max-w-2xl leading-[1.1]">
                    Jadwal LPKBJJ
                </h1>
                <p class="font-body text-lg text-primary-fixed max-w-xl opacity-90 leading-relaxed">
                    Akses informasi jadwal Layanan Pendukung Kesuksesan Belajar Jarak Jauh (LPKBJJ)
                </p>
            </div>
        </section>

        <!-- Search/Form Section -->
        <section class="max-w-[1440px] mx-auto px-8 -mt-16 relative z-20 mb-16">
            <div
                class="bg-surface-container-lowest rounded-xl shadow-[0_12px_32px_rgba(24,28,32,0.04)] p-8 md:p-12 flex flex-col md:flex-row items-center gap-8 border border-outline-variant/20">
                <div class="flex-1 space-y-2">
                    <h2 class="font-headline text-2xl font-bold text-primary">Cek Jadwal LPKBJJ </h2>
                    <p class="text-on-surface-variant text-sm">Masukkan Nomor Induk Mahasiswa (NIM) Anda untuk melihat
                        jadwal LPKBJJ Anda.</p>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row gap-4 flex-grow max-w-2xl">
                    <div class="relative flex-grow">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">badge</span>
                        <input id="data-id"
                            class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-xl border-none focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all text-on-surface"
                            placeholder="Masukkan NIM (e.g. 041234567)" type="text" />
                    </div>
                    <button id="get-data"
                        class="bg-secondary-container text-on-secondary-container px-8 py-4 rounded-xl font-headline font-bold flex items-center justify-center gap-2 hover:brightness-95 active:scale-95 transition-all">
                        <span class="material-symbols-outlined">search</span>
                        Cari Jadwal
                    </button>
                </div>
            </div>

            <div id="loading-indicator" class="hidden text-center text-primary font-semibold mt-4">
                Sedang mencari jadwal Anda...
            </div>
            <div id="error-message" class="hidden text-center text-error font-semibold mt-4"></div>
        </section>

        <!-- Data Table Section -->
        <section class="max-w-[1440px] mx-auto px-8 pb-24">
            <div class="flex items-baseline justify-between mb-8">
                <h3 class="font-headline text-3xl font-extrabold text-on-surface tracking-tight">Jadwal LPKBJJ Anda</h3>
                <span class="font-label text-xs font-bold text-outline-variant uppercase tracking-widest">Pencarian
                    Real-Time</span>
            </div>

            <div id="jadwal-table-container"
                class="hidden bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/10 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full academic-table text-left border-collapse min-w-[700px]">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant/20">
                                <th class="px-8 py-5 font-bold">Mahasiswa</th>
                                <th class="px-8 py-5 font-bold">Nama Kegiatan</th>
                                <th class="px-8 py-5 font-bold">Tanggal Pelaksanaan</th>
                                <th class="px-8 py-5 font-bold">Waktu</th>
                                <th class="px-8 py-5 font-bold">Skema</th>
                                <th class="px-8 py-5 font-bold">Nomor Meja</th>
                                <th class="px-8 py-5 font-bold">No Urut</th>
                                <th class="px-8 py-5 font-bold">Lokasi / Link</th>
                            </tr>
                        </thead>
                        <tbody id="result-tbody" class="divide-y divide-surface-container">
                            <!-- Data will be loaded via AJAX -->
                        </tbody>
                    </table>
                </div>

                <div
                    class="p-8 bg-surface-container-lowest border-t border-outline-variant/20 flex flex-col md:flex-row gap-8">
                    <div class="flex-1">
                        <h4 class="font-headline font-bold text-lg text-primary mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-xl">rule</span> Ketentuan
                        </h4>
                        <ul class="list-decimal pl-5 text-sm text-on-surface-variant space-y-2 leading-relaxed">
                            <li>Dress code: kemeja putih, celana/rok hitam, rapi dan bersepatu, serta wajib mengenakan
                                jaket almamater.</li>
                            <li>Model dan warna jaket harus sesuai dengan jaket almamater Universitas Terbuka Jakarta.
                            </li>
                            <li>Pembelian jaket almamater dapat dibeli secara langsung di lokasi LPKBJJ.</li>
                        </ul>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-headline font-bold text-lg text-error mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-xl">info</span> Catatan
                        </h4>
                        <ul class="list-decimal pl-5 text-sm text-on-surface-variant space-y-2 leading-relaxed">
                            <li>Mahasiswa yang namanya belum tercantum dimohon menunggu tahap LPKBJJ berikutnya.</li>
                            <li>Mahasiswa wajib mengikuti seluruh rangkaian kegiatan sampai selesai.</li>
                            <li>Dilarang merokok di lokasi pelaksanaan LPKBJJ.</li>
                            <li id="tugas-pkbjj-wt-link" class="hidden">Mahasiswa wajib mendownload format tugas PKBJJ & WT melalui link berikut: <a href="https://sl.ut.ac.id/lembar_tugas_pkbjj_utjkt" target="_blank" class="text-primary hover:underline font-bold">sl.ut.ac.id/lembar_tugas_pkbjj_utjkt</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="no-data-state"
                class="hidden bg-surface-container-lowest border border-outline-variant/10 rounded-xl p-12 text-center flex-col items-center shadow-sm">
                <span class="material-symbols-outlined text-outline text-5xl mb-4">inbox</span>
                <h5 class="font-headline text-2xl font-bold text-on-surface mb-2">Belum ada data</h5>
                <p class="text-on-surface-variant max-w-sm mx-auto">Silakan ketikkan NIM Anda pada kotak pencarian di
                    atas untuk memuat jadwal LPKBJJ.</p>
            </div>

            <!-- Asymmetric Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                <div
                    class="md:col-span-2 bg-primary-container p-8 rounded-xl text-on-primary-container flex flex-col justify-between min-h-[240px]">
                    <div class="max-w-md">
                        <h4 class="font-headline text-2xl font-bold mb-4">Butuh Bantuan Akademik?</h4>
                        <p class="opacity-80 leading-relaxed mb-6">Layanan pendampingan LPKBJJ tersedia. Konsultasikan
                            jadwal Anda dengan layanan support UT Jakarta.</p>
                    </div>
                    <div>
                        <a href="https://sl.ut.ac.id/pelayanan_online_utjkt" target="_blank"
                            class="inline-flex items-center gap-2 bg-white text-primary-container font-headline font-bold px-6 py-3 rounded-full hover:bg-opacity-90 transition-all shadow-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary-container">
                            <span class="material-symbols-outlined text-sm">headset_mic</span>
                            Pelayanan Online UT Jakarta
                        </a>
                    </div>
                </div>
                <a href="https://www.ut.ac.id/kalender-akademik/" target="_blank"
                    class="bg-secondary-container p-8 rounded-xl flex flex-col justify-center gap-6 hover:-translate-y-1 hover:shadow-lg transition-transform transition-shadow duration-300 cursor-pointer group">
                    <div
                        class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors duration-300">
                        <span
                            class="material-symbols-outlined text-on-secondary-container text-3xl">event_available</span>
                    </div>
                    <div>
                        <h4
                            class="font-headline text-xl font-bold text-on-secondary-container mb-2 flex items-center justify-between">
                            Kalender Akademik
                            <span
                                class="material-symbols-outlined opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">arrow_forward</span>
                        </h4>
                        <p class="text-on-secondary-container/70 text-sm leading-relaxed mb-0">Pastikan Anda tidak
                            melewatkan kegiatan akademik penting.</p>
                    </div>
                </a>
            </div>

        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-200">
        <div class="flex justify-between items-center px-12 py-10 w-full max-w-[1440px] mx-auto">
            <div class="flex flex-col gap-2">
                <div class="text-lg font-bold text-slate-800 font-headline">UT Jakarta</div>
                <p class="font-['Inter'] text-sm tracking-normal text-slate-500">© 2024 Universitas Terbuka Jakarta.
                    Excellence in Open and Distance Learning.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Init state
            $('#no-data-state').removeClass('hidden').addClass('flex');

            $('#get-data').on('click', function (e) {
                e.preventDefault();
                var id = $('#data-id').val();

                if (id) {
                    // UI Preloader
                    $('#jadwal-table-container').addClass('hidden');
                    $('#no-data-state').addClass('hidden').removeClass('flex');
                    $('#error-message').addClass('hidden');
                    $('#loading-indicator').removeClass('hidden');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('cekjadwalpkbjj') }}",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            nim: id,
                        },
                        success: function (response) {
                            $('#loading-indicator').addClass('hidden');

                            var data = response.data;

                            if (data && data.length > 0) {
                                var tableHtml = '';
                                var isPkbjjWt = false;
                                $.each(data, function(index, item) {
                                    if (item.nama_kegiatan && item.nama_kegiatan.toUpperCase().includes('PKBJJ') && item.nama_kegiatan.toUpperCase().includes('WT')) {
                                        isPkbjjWt = true;
                                    }
                                    tableHtml += `
                                    <tr class="hover:bg-surface-container-low transition-colors group">
                                        <td class="px-8 py-6">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-on-surface uppercase tracking-wide">${item.nama || '-'}</span>
                                                <span class="text-sm font-medium text-outline">${item.nim || '-'}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="text-sm font-semibold text-on-surface">${item.nama_kegiatan || '-'}</div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-2 text-on-surface mb-1">
                                                <span class="material-symbols-outlined text-sm text-primary">event</span>
                                                <span class="text-sm font-bold text-primary">${item.tanggal || '-'}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-2 text-on-surface mb-1">
                                                <span class="material-symbols-outlined text-sm text-tertiary">schedule</span>
                                                <span class="text-sm font-bold text-tertiary">${item.waktu || '-'}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="text-sm font-semibold text-on-surface">${item.skema || '-'}</div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="text-sm font-bold text-primary">${item.nomor_meja || '-'}</div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="text-sm font-bold text-error">${item.no_urut || '-'}</div>
                                        </td>
                                        <td class="px-8 py-6 min-w-[200px]">
                                            <div class="flex flex-col gap-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-sm text-tertiary">location_on</span>
                                                    <a href="${item.link_lok && item.link_lok.startsWith('http') ? item.link_lok : 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(item.link_lok || '')}" target="_blank" class="text-sm font-medium text-primary hover:underline transition-colors">
                                                        ${item.link_lok || '-'}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>`;
                                });
                                $('#result-tbody').html(tableHtml);
                                $('#jadwal-table-container').removeClass('hidden');

                                if (isPkbjjWt) {
                                    $('#tugas-pkbjj-wt-link').removeClass('hidden');
                                } else {
                                    $('#tugas-pkbjj-wt-link').addClass('hidden');
                                }
                            } else {
                                $('#no-data-state').removeClass('hidden').addClass('flex');
                                $('#no-data-state h5').text('Data tidak ditemukan');
                                $('#no-data-state p').text('Data kosong. Silakan pastikan NIM yang dicari benar atau jadwal belum keluar.');
                            }
                        },
                        error: function (xhr) {
                            $('#loading-indicator').addClass('hidden');
                            $('#error-message').removeClass('hidden');

                            if (xhr.status == 404 || xhr.status == 400 || xhr.status == 422) {
                                $('#error-message').text('Anda Tidak Terdaftar LPKBJJ Gelombang Ini');
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                $('#error-message').text('Terjadi kesalahan: ' + xhr.responseJSON.message);
                            } else {
                                $('#error-message').text('Anda Tidak Terdaftar LPKBJJ Gelombang Ini');
                            }

                            $('#no-data-state').removeClass('hidden').addClass('flex');
                            $('#no-data-state h5').text('Gagal memuat jadwal');
                            $('#no-data-state p').text('Silakan coba kembali dalam beberapa saat lagi atau cek penulisan NIM Anda.');
                        }
                    });
                } else {
                    $('#error-message').removeClass('hidden').text('NIM tidak boleh kosong. Mohon ketikkan NIM terlebih dahulu.');
                }
            });
        });
    </script>
</body>

</html>