@once
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/brand.css') }}" rel="stylesheet">
@endonce

<header class="brand-nav">
    <div class="wrap">
        <a class="brand-mark" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('img/logo.png') }}" alt="" width="36" height="36">
            <span>
                <strong>GamiCampus AR</strong>
                <small>Panel admin</small>
            </span>
        </a>

        <button type="button" class="nav-toggle" id="navToggle" aria-controls="navMenu" aria-expanded="false">Menu</button>

        <div class="nav-menu" id="navMenu">
            <nav aria-label="Menu admin">
                <ul>
                    <li><a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a class="{{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Pengguna</a></li>
                    <li><a class="{{ request()->routeIs('admin.missions.*') ? 'active' : '' }}" href="{{ route('admin.missions.index') }}">Misi</a></li>
                    <li><a class="{{ request()->routeIs('admin.badges.*') ? 'active' : '' }}" href="{{ route('admin.badges.index') }}">Lencana</a></li>
                    <li><a class="{{ request()->routeIs('admin.locations.*') ? 'active' : '' }}" href="{{ route('admin.locations.index') }}">Lokasi</a></li>
                </ul>
            </nav>
            <div class="who">
                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    (function () {
        var toggle = document.getElementById('navToggle');
        var menu = document.getElementById('navMenu');
        if (!toggle || !menu) return;
        toggle.addEventListener('click', function () {
            var open = menu.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    })();
</script>
