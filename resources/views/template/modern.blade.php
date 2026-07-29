<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>@yield('title', 'Dashboard Pembelajaran UT Jakarta')</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-ut-jakarta.png') }}?v=2">
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
    rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "background": "#f7f9ff",
            "tertiary-container": "#5275ac",
            "surface-container-high": "#e5e8ee",
            "on-primary-container": "#fcfcff",
            "on-primary-fixed-variant": "#004b71",
            "surface-container": "#eaeef4",
            "on-primary-fixed": "#001e30",
            "on-secondary-fixed-variant": "#544600",
            "primary-container": "#007bb6",
            "on-tertiary-fixed": "#001b3c",
            "on-surface-variant": "#3f4850",
            "tertiary-fixed-dim": "#a7c8ff",
            "on-tertiary-fixed-variant": "#1f477b",
            "surface-container-lowest": "#ffffff",
            "on-secondary-container": "#6e5c00",
            "on-secondary": "#ffffff",
            "on-secondary-fixed": "#221b00",
            "primary": "#006191",
            "tertiary": "#385d92",
            "surface-variant": "#dfe3e9",
            "inverse-surface": "#2c3135",
            "on-error-container": "#93000a",
            "surface-container-low": "#f0f4fa",
            "outline-variant": "#bec7d2",
            "on-primary": "#ffffff",
            "surface": "#f7f9ff",
            "secondary": "#705d00",
            "on-surface": "#181c20",
            "surface-tint": "#006495",
            "secondary-fixed": "#ffe16d",
            "error-container": "#ffdad6",
            "secondary-fixed-dim": "#e9c400",
            "primary-fixed-dim": "#8fcdff",
            "outline": "#6f7881",
            "on-tertiary-container": "#fefcff",
            "surface-container-highest": "#dfe3e9",
            "primary-fixed": "#cbe6ff",
            "on-tertiary": "#ffffff",
            "on-background": "#181c20",
            "tertiary-fixed": "#d5e3ff",
            "secondary-container": "#fcd400",
            "on-error": "#ffffff",
            "error": "#ba1a1a",
            "surface-bright": "#f7f9ff",
            "surface-dim": "#d7dae0",
            "inverse-primary": "#8fcdff"
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

    .tonal-transition {
      background: linear-gradient(to bottom, #f7f9ff, #f0f4fa);
    }

    .glass-nav {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(24px);
    }
  </style>

  @yield('custom_style')
    @include('partials.analytics')
</head>

<body class="bg-background font-body text-on-surface">
  <!-- TopNavBar -->
  <nav class="fixed top-0 w-full z-50 glass-nav shadow-sm shadow-sky-900/5">
    <div class="flex justify-between items-center h-16 px-6 lg:px-12 max-w-full mx-auto">
      <div class="flex items-center gap-6">
        <div class="flex items-center gap-3">
          <img src="{{ asset('assets/img/logo-ut-jakarta.png') }}?v=2" alt="UT Logo" class="h-10 w-auto">
          <span class="text-base md:text-lg font-bold tracking-tight text-sky-800 font-headline leading-tight">Dashboard Pembelajaran<br><span class="text-sm md:text-base text-sky-600">UT Jakarta</span></span>
        </div>
        <div class="hidden md:flex gap-6 items-center ml-4 border-l border-sky-100 pl-6 h-8">
          <a class="font-manrope text-sm tracking-tight text-sky-700 font-bold relative after:content-[''] after:absolute after:-bottom-2 after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-1 after:bg-yellow-500 after:rounded-full"
            href="{{ route('home') }}">Dashboard</a>
        </div>
      </div>
    </div>
  </nav>

  @yield('content')

  <!-- Footer -->
  <footer class="w-full py-12 border-t-0 bg-slate-50">
    <div class="max-w-full lg:px-24 mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 px-6">
      <div class="flex flex-col gap-4">
        <span class="font-manrope font-semibold text-slate-900">Dashboard Pembelajaran UT Jakarta</span>
        <p class="font-inter text-xs tracking-wide uppercase text-slate-500">© 2024 Universitas Terbuka Jakarta.
          Excellence in Open Education.</p>
      </div>
      <div class="flex flex-wrap gap-x-8 gap-y-4 md:justify-end items-center">
        <a class="font-inter text-xs tracking-wide uppercase text-slate-500 hover:text-yellow-600 transition-colors"
          href="https://www.instagram.com/ut_jakarta/" target="_blank">Instagram</a>
        <a class="font-inter text-xs tracking-wide uppercase text-slate-500 hover:text-yellow-600 transition-colors"
          href="https://twitter.com/UT_Jakarta" target="_blank">Twitter</a>
        <a class="font-inter text-xs tracking-wide uppercase text-slate-500 hover:text-yellow-600 transition-colors"
          href="https://www.facebook.com/UnivTer/" target="_blank">Facebook</a>
        <a class="font-inter text-xs tracking-wide uppercase text-slate-500 hover:text-yellow-600 transition-colors"
          href="https://www.youtube.com/channel/UCaiWEDIkH6rLY7O93sWL7oA/featured" target="_blank">Youtube</a>
      </div>
    </div>
  </footer>

  @include('sweetalert::alert')
  @yield('custom_script')
</body>

</html>
