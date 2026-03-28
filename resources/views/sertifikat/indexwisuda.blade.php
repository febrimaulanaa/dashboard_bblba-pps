@extends('template.modern')

@section('title', 'Cek Meja Wisuda - Dashboard Pembelajaran UT Jakarta')

@section('content')
  <main class="mt-24 pb-20 min-h-[calc(100vh-200px)] flex flex-col justify-center items-center px-6">
    <div class="w-full max-w-2xl text-center mb-12">
      <h1 class="text-3xl md:text-4xl font-extrabold font-headline tracking-tight text-primary mb-2">Form Cek Meja Ambil Ijazah</h1>
      <h2 class="text-xl md:text-2xl font-bold text-sky-700">Universitas Terbuka Jakarta</h2>
      <p class="text-on-surface-variant mt-4 text-sm md:text-base">Masukkan Nomor Induk Mahasiswa Anda untuk melihat informasi ketersediaan dan nomor meja wisuda.</p>
    </div>

    <div class="bg-surface-container-lowest p-8 md:p-12 rounded-2xl shadow-xl border border-outline-variant/10 w-full max-w-xl relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute -top-24 -right-24 w-48 h-48 bg-primary/5 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-secondary/5 rounded-full blur-3xl"></div>
      
      <div class="relative z-10">
        <form action="{{ route('mejaijazah.verify') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="nim" class="block text-sm font-bold text-on-surface mb-2 font-headline">Nomor Induk Mahasiswa</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline">
                        <span class="material-symbols-outlined text-[20px]">badge</span>
                    </div>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM Anda" required
                        class="block w-full pl-12 pr-4 py-4 bg-surface rounded-xl border-outline-variant/50 focus:border-primary focus:ring focus:ring-primary/20 transition-all font-body text-on-surface placeholder-outline-variant shadow-inner">
                </div>
            </div>
            
            <button type="submit" class="w-full bg-primary hover:bg-sky-800 text-on-primary font-bold py-4 px-6 rounded-xl transition-all shadow-md active:scale-[0.98] flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">event_seat</span>
                Lihat Informasi Meja
            </button>
        </form>
      </div>
    </div>
  </main>
@endsection
