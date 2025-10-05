<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                        href="{{ route('admin.users') }}">Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.missions.*') ? 'active' : '' }}"
                        href="{{ route('admin.missions.index') }}">Misi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.badges.*') ? 'active' : '' }}"
                        href="{{ route('admin.badges.index') }}">Lencana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}"
                        href="{{ route('admin.locations.index') }}">Lokasi AR</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
        </div>
    </div>
</nav>
