<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - GamiCampus AR</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/brand.css') }}" rel="stylesheet">
</head>
<body class="brand">
    <div class="login-shell">
        <aside class="login-photo" aria-hidden="true">
            <img src="{{ asset('img/teknik-informatika.jpg') }}" alt="" width="1800" height="963">
            <div class="caption">
                <span class="eyebrow">Panel admin</span>
                <p>Kelola misi, lencana, dan pemain GamiCampus AR.</p>
            </div>
        </aside>

        <main class="login-panel">
            <div class="login-box">
                <a href="{{ url('/') }}" class="brand-mark">
                    <img src="{{ asset('img/logo.png') }}" alt="" width="42" height="42">
                    <span>
                        <strong>GamiCampus AR</strong>
                        <small>Politeknik Negeri Bengkalis</small>
                    </span>
                </a>

                <h1>Masuk ke panel admin</h1>
                <p class="sub">Gunakan akun admin untuk mengelola konten aplikasi.</p>

                @if ($errors->any())
                    <div class="alert-flat" role="alert">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" novalidate>
                    @csrf
                    <div class="field {{ $errors->has('email') ? 'invalid' : '' }}">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="username" placeholder="nama@polbeng.ac.id" required autofocus>
                    </div>
                    <div class="field {{ $errors->has('password') ? 'invalid' : '' }}">
                        <label for="password">Kata sandi</label>
                        <div class="pw-wrap">
                            <input type="password" id="password" name="password" autocomplete="current-password" required>
                            <button type="button" class="pw-toggle" id="pwToggle" aria-controls="password" aria-pressed="false">Tampilkan</button>
                        </div>
                    </div>
                    <button type="submit" class="btn-brand indigo block">Masuk</button>
                </form>

                <a href="{{ url('/') }}" class="login-back">&larr; Kembali ke beranda</a>
            </div>
        </main>
    </div>

    <script>
        (function () {
            var btn = document.getElementById('pwToggle');
            var input = document.getElementById('password');
            btn.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.textContent = show ? 'Sembunyikan' : 'Tampilkan';
                btn.setAttribute('aria-pressed', show ? 'true' : 'false');
            });
        })();
    </script>
</body>
</html>
