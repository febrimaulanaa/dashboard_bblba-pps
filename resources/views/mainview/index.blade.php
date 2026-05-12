@extends('template.modern')

@section('content')
  <main class="mt-16 pb-20">
    <!-- Hero Section: Welcome & Stats -->
    <section class="relative pt-12 pb-24 px-6 lg:px-24 overflow-hidden">
      <div class="absolute inset-0 z-0 opacity-5">
        <img class="w-full h-full object-cover"
          data-alt="wide shot of a modern minimalist university library architecture with clean lines and large windows"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgETw5qOzb8BKB02BkSRC1K66z5CiEVEUZShpqMMzBa_daYuAZjbvlZdYtYmeKJ02sb5Iga8gIoEXy5pR03crr6Gis40i3yf7wBicpcuL8RrL-Dt1kNXB9V6sFb8oly03Hh68z52bliZy1UcQ_uB2xTnYyHweA_9vw0gz3XPYZ0aqpapgatXX7o-Ih7Is5KiyV_Fq2n2IzP8sDaMMq6xWrjoyy3gacnZZUJrogbZ-feQsWwnLh86zW3TCkw7zgJ87jjiPXG8e5uyOD" />
      </div>
      <div class="relative z-10 max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
          <div>
            <h1 class="text-4xl lg:text-5xl font-extrabold font-headline tracking-tight text-primary mb-2">Dashboard
              Pembelajaran, Kemahasiswaan, dan Alumni UT Jakarta</h1>

          </div>
          <div class="grid grid-cols-2 gap-4 w-full lg:w-auto">
            <div
              class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col gap-1 min-w-[180px]">
              <span class="text-secondary font-bold text-3xl">04</span>
              <span class="text-on-surface-variant text-sm font-medium uppercase tracking-wider">Layanan
                Sertifikat</span>
            </div>
            <div class="bg-primary p-6 rounded-xl shadow-sm flex flex-col gap-1 min-w-[180px]">
              <span class="text-on-primary font-bold text-3xl">02</span>
              <span class="text-primary-fixed text-sm font-medium uppercase tracking-wider">Layanan Akademik</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="max-w-7xl mx-auto px-6 lg:px-12 -mt-12 space-y-12 relative z-20">
      <!-- Promotional Banner -->
      <!-- <section class="w-full bg-primary rounded-xl overflow-hidden relative group">
        <div class="absolute inset-0 opacity-30 group-hover:scale-105 transition-transform duration-700">
          <img class="w-full h-full object-cover"
            data-alt="vibrant graduation ceremony scene with caps being thrown in the air against a bright blue sky"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCLAhMhx99QLi_zB9CGFZuXuYmej3lsZMeseR1jRVbhV3KBUaIXNCEaSfGL6FojMIrGfv-XIYpKfvJsVMWRYJ2OK-Pok9XG383LjM07RWu9VsHtv79rXD7ZNniA3fS9L1sFFu-hglFkE6JriXJisn0o5SUu74OU2i5oxczQq69s2qnP_VTnwttyxW1Jevtf0hWI8wSCkWn27ReDf4yogvvvlDgnGxuzxDBBQ9Stib8O4GbkoEIMuO0MPkHAtEq1eRsuSB332Pk-0-wf" />
        </div>
        <div class="relative p-8 lg:p-12 flex flex-col lg:flex-row items-center justify-between gap-8">
          <div class="text-center lg:text-left">
            <span
              class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">Pendaftaran
              Dibuka</span>
            <h2 class="text-3xl lg:text-4xl font-headline font-bold text-on-primary mb-4">Wisuda Periode II 2024 Telah
              Dibuka</h2>
            <p class="text-primary-fixed text-lg max-w-lg">Pastikan Anda telah memenuhi seluruh persyaratan akademis
              untuk mengikuti prosesi wisuda tahun ini.</p>
          </div>
          <a href="{{ route('mejaijazah') }}"
            class="bg-secondary-container text-on-secondary-container px-8 py-4 rounded-xl font-headline font-bold text-sm tracking-tight hover:brightness-105 transition-all shadow-xl active:scale-95 inline-block text-center">
            Daftar Sekarang
          </a>
        </div>
      </section> -->
      <!-- Grid Layout for Certificates and Academic -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Certificates Section (2/3 width) -->
        <div class="lg:col-span-2 space-y-6">
          <div class="flex items-center justify-between">
            <h3 class="text-xl font-headline font-bold text-on-surface">Sertifikat &amp; Kompetensi</h3>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Card 1 -->
            <a href="{{ route('sertifosmb') }}" class="block h-full">
              <div
                class="bg-surface-container-lowest p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow group border border-outline-variant/10 h-full flex flex-col">
                <div class="flex justify-between items-start mb-6">
                  <div class="w-12 h-12 bg-sky-50 rounded-lg flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">school</span>
                  </div>
                  <div class="text-slate-400 group-hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </div>
                </div>
                <h4 class="font-headline font-bold text-on-surface mb-1">Sertifikat OSMB</h4>
                <p class="text-on-surface-variant text-sm mb-4">Orientasi Studi Mahasiswa Baru</p>
                <div class="h-1 w-full bg-surface-container rounded-full overflow-hidden mt-auto">
                  <div class="h-full bg-primary w-full"></div>
                </div>
              </div>
            </a>
            <!-- Card 2 -->
            <a href="{{ route('sertif') }}" class="block h-full">
              <div
                class="bg-surface-container-lowest p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow group border border-outline-variant/10 h-full flex flex-col">
                <div class="flex justify-between items-start mb-6">
                  <div class="w-12 h-12 bg-yellow-50 rounded-lg flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined">psychology</span>
                  </div>
                  <div class="text-slate-400 group-hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </div>
                </div>
                <h4 class="font-headline font-bold text-on-surface mb-1">Sertifikat PKBJJ</h4>
                <p class="text-on-surface-variant text-sm mb-4">Pelatihan Keterampilan Belajar</p>
                <div class="h-1 w-full bg-surface-container rounded-full overflow-hidden mt-auto">
                  <div class="h-full bg-secondary w-full"></div>
                </div>
              </div>
            </a>
            <!-- Card 3 -->
            <a href="{{ route('sertifwtku') }}" class="block h-full">
              <div
                class="bg-surface-container-lowest p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow group border border-outline-variant/10 h-full flex flex-col">
                <div class="flex justify-between items-start mb-6">
                  <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">work</span>
                  </div>
                  <div class="text-slate-400 group-hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </div>
                </div>
                <h4 class="font-headline font-bold text-on-surface mb-1">Sertifikat WTKU</h4>
                <p class="text-on-surface-variant text-sm mb-4">Workshop Tugas Kuliah</p>
                <div class="h-1 w-full bg-surface-container rounded-full overflow-hidden mt-auto">
                  <div class="h-full bg-emerald-500 w-full"></div>
                </div>
              </div>
            </a>
            <!-- Card 4 -->
            <a href="{{ route('sertifseminar') }}" class="block h-full">
              <div
                class="bg-surface-container-lowest p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow group border border-outline-variant/10 h-full flex flex-col">
                <div class="flex justify-between items-start mb-6">
                  <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                    <span class="material-symbols-outlined">groups</span>
                  </div>
                  <div class="text-slate-400 group-hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </div>
                </div>
                <h4 class="font-headline font-bold text-on-surface mb-1">Sertifikat Seminar</h4>
                <p class="text-on-surface-variant text-sm mb-4">Seminar Akademik Jakarta</p>
                <div class="h-1 w-full bg-surface-container rounded-full overflow-hidden mt-auto">
                  <div class="h-full bg-purple-500 w-full"></div>
                </div>
              </div>
            </a>
            
            @if(isset($activeEvents) && $activeEvents->count() > 0)
                @foreach($activeEvents as $event)
                    <!-- Dynamic Event Card -->
                    <a href="{{ route('sertifikat.form', $event->slug) }}" class="block h-full">
                        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow group border border-outline-variant/10 h-full flex flex-col">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                            <span class="material-symbols-outlined">event</span>
                            </div>
                            <div class="text-slate-400 group-hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">arrow_forward</span>
                            </div>
                        </div>
                        <h4 class="font-headline font-bold text-on-surface mb-1">{{ $event->name }}</h4>
                        <p class="text-on-surface-variant text-sm mb-4">{{ \Illuminate\Support\Str::limit($event->description, 50) }}</p>
                        <div class="h-1 w-full bg-surface-container rounded-full overflow-hidden mt-auto">
                            <div class="h-full bg-blue-500 w-full"></div>
                        </div>
                        </div>
                    </a>
                @endforeach
            @endif
          </div>
        </div>
        <!-- Academic Section (1/3 width) -->
        <div class="space-y-6">
          <h3 class="text-xl font-headline font-bold text-on-surface">Informasi Akademik</h3>
          <div class="space-y-4">
            <!-- Jadwal Tutorial Card -->
            <div class="bg-white border-2 border-primary/5 p-6 rounded-xl shadow-sm">
              <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary mb-4">
                <span class="material-symbols-outlined">calendar_month</span>
              </div>
              <h4 class="font-headline font-bold text-on-surface mb-1">Jadwal Tutorial</h4>
              <p class="text-on-surface-variant text-xs mb-6">Pengecekan jadwal TTM / Tuweb untuk Mahasiswa dan Tutor.</p>
              <div class="flex flex-col gap-2">
                <a class="block w-full text-center py-2.5 bg-surface-container text-primary font-bold text-xs rounded-lg hover:bg-primary hover:text-white transition-all flex items-center justify-center gap-2"
                  href="{{ route('jadwaltuwebmhs') }}">
                  <span class="material-symbols-outlined text-[16px]">school</span>
                  Jadwal Mahasiswa
                </a>
                <a class="block w-full text-center py-2.5 bg-surface-container text-primary font-bold text-xs rounded-lg hover:bg-primary hover:text-white transition-all flex items-center justify-center gap-2"
                  href="{{ route('jadwaltuwebtutor') }}">
                  <span class="material-symbols-outlined text-[16px]">co_present</span>
                  Jadwal Tutor
                </a>
              </div>
            </div>
            <!-- Wisuda Card -->
            <div class="bg-white border-2 border-primary/5 p-6 rounded-xl shadow-sm">
              <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary mb-4">
                <span class="material-symbols-outlined">event_seat</span>
              </div>
              <h4 class="font-headline font-bold text-on-surface mb-1">Nomor Meja Wisuda</h4>
              <p class="text-on-surface-variant text-xs mb-6">Cek ketersediaan dan nomor kursi Anda untuk prosesi wisuda
                mendatang.</p>
              <a class="block w-full text-center py-3 bg-surface-container text-primary font-bold text-xs rounded-lg hover:bg-primary hover:text-white transition-all"
                href="{{ route('mejaijazah') }}">
                Periksa Detail
              </a>
            </div>
            <!-- Quick Support -->
            <a href="https://sl.ut.ac.id/pelayanan_online_utjkt" target="_blank" class="block">
              <div
                class="bg-secondary-container/10 p-4 rounded-xl flex items-center gap-4 hover:bg-secondary-container/20 transition-colors">
                <div
                  class="w-10 h-10 bg-secondary-container rounded-lg flex items-center justify-center text-on-secondary-container">
                  <span class="material-symbols-outlined">support_agent</span>
                </div>
                <div>
                  <h5 class="text-sm font-bold text-on-surface">Butuh Bantuan?</h5>
                  <p class="text-[10px] text-on-surface-variant">Hubungi Pelayanan Online UT Jakarta</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
  </main>
@endsection