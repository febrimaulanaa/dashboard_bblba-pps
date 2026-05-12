<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin UT Jakarta</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Inter:wght@100..900&display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                  primary: "#006191",
                  "primary-container": "#007bb6",
                  "on-primary": "#ffffff",
                  background: "#f7f9ff",
                  surface: "#f7f9ff",
                  "surface-container-low": "#f0f4fa",
                  "surface-container-lowest": "#ffffff",
                  "on-surface": "#181c20",
                  "on-surface-variant": "#3f4850",
                  error: "#ba1a1a",
                  "outline-variant": "#bec7d2",
              },
              fontFamily: {
                  headline: ["Manrope", "sans-serif"],
                  body: ["Inter", "sans-serif"],
              }
            }
          }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background min-h-screen flex items-center justify-center font-body p-4 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-primary/5 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 rounded-full bg-primary/10 blur-3xl"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-primary mx-auto rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-primary/30">
                <span class="material-symbols-outlined text-on-primary text-3xl">school</span>
            </div>
            <h1 class="text-3xl font-headline font-black text-on-surface tracking-tight mb-2">Admin Portal</h1>
            <p class="text-on-surface-variant">Universitas Terbuka Jakarta</p>
        </div>

        <div class="bg-surface-container-lowest p-8 rounded-3xl shadow-[0_12px_32px_rgba(24,28,32,0.04)] border border-outline-variant/20">
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                
                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-error/10 border border-error/20 flex items-start gap-3">
                        <span class="material-symbols-outlined text-error">error</span>
                        <div class="text-error text-sm font-medium mt-0.5">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-2">Username</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50">person</span>
                            <input type="text" name="username" value="{{ old('username') }}" class="w-full bg-surface-container-low border-none rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all" placeholder="Masukkan username" required autofocus>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-2">Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50">lock</span>
                            <input type="password" name="password" class="w-full bg-surface-container-low border-none rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 mt-2 bg-gradient-to-br from-primary to-primary-container text-on-primary rounded-xl font-bold shadow-md shadow-primary/20 hover:opacity-90 transition-all flex justify-center items-center gap-2">
                        <span>Masuk ke Dashboard</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>
        <p class="text-center text-xs text-on-surface-variant/70 mt-8 font-medium">
            &copy; 2024 Universitas Terbuka Jakarta
        </p>
    </div>
</body>
</html>
