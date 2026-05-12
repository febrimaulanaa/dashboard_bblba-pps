<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin UT Jakarta</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            background: #f7f9ff; 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 1rem;
        }
        .container { width: 100%; max-width: 420px; }
        .logo-box { 
            width: 64px; height: 64px; 
            background: #006191; 
            border-radius: 12px; 
            display: flex; align-items: center; justify-content: center; 
            margin: 0 auto 1rem;
        }
        .logo-text { color: white; font-size: 28px; }
        h1 { text-align: center; font-size: 24px; font-weight: 800; color: #181c20; margin-bottom: 4px; }
        .subtitle { text-align: center; color: #3f4850; margin-bottom: 2rem; }
        .form-box { 
            background: #fff; 
            padding: 2rem; 
            border-radius: 16px; 
            border: 1px solid #bec7d2;
            box-shadow: 0 12px 32px rgba(24,28,32,0.04);
        }
        .error-box { 
            background: #fef2f2; 
            border: 1px solid #fecaca; 
            padding: 1rem; 
            border-radius: 8px; 
            margin-bottom: 1.5rem; 
            color: #ba1a1a;
        }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-size: 12px; font-weight: 700; color: #3f4850; text-transform: uppercase; margin-bottom: 0.5rem; }
        input { 
            width: 100%; 
            padding: 12px 16px; 
            background: #f0f4fa; 
            border: none; 
            border-radius: 8px; 
            font-size: 14px;
        }
        input:focus { outline: 2px solid #006191; background: #fff; }
        button { 
            width: 100%; 
            padding: 14px; 
            background: #006191; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-size: 14px; 
            font-weight: 600; 
            cursor: pointer;
            margin-top: 0.5rem;
        }
        button:hover { background: #007bb6; }
        .footer { text-align: center; font-size: 12px; color: #3f4850; margin-top: 2rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-box">
            <span class="logo-text">&#x1F393;</span>
        </div>
        <h1>Admin Portal</h1>
        <p class="subtitle">Universitas Terbuka Jakarta</p>

        <div class="form-box">
            @if($errors->any())
                <div class="error-box" id="error-box">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form id="login-form">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required autofocus>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" id="login-btn">Masuk ke Dashboard</button>
            </form>
            <script>
                document.getElementById('login-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    var btn = document.getElementById('login-btn');
                    btn.disabled = true;
                    btn.textContent = 'Memuat...';
                    
                    var formData = new FormData(this);
                    var params = new URLSearchParams(formData).toString();
                    
                    window.location.href = '{{ url("/app/enter") }}?' + params;
                });
            </script>
        </div>
        <p class="footer">&copy; 2024 Universitas Terbuka Jakarta</p>
    </div>
</body>
</html>
