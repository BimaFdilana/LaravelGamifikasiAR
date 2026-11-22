<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - GamiCampus AR</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
</head>
<body class="brand">
    @include('admin.partials.navbar')

    <main class="admin-main">
        <div class="wrap">
            <div class="page-head">
                <div>
                    <h1>Halo, {{ \Illuminate\Support\Str::of(auth()->user()->name)->before(' ') }}</h1>
                    <p>Ringkasan aktivitas pemain GamiCampus AR.</p>
                </div>
                <div class="today">{{ now('Asia/Jakarta')->locale('id')->translatedFormat('l, j F Y') }}</div>
            </div>

            <section class="stats" aria-label="Statistik">
                <div class="stat">
                    <div class="label">Pemain terdaftar</div>
                    <div class="value">{{ number_format($totalUsers) }}</div>
                    <div class="hint">Akun dengan peran mahasiswa</div>
                </div>
                <div class="stat s-amber">
                    <div class="label">Misi selesai</div>
                    <div class="value">{{ number_format($missionsCompleted) }}</div>
                    <div class="hint">Total dari semua pemain</div>
                </div>
                <div class="stat s-sky">
                    <div class="label">Misi tersedia</div>
                    <div class="value">{{ number_format($totalMissions) }}</div>
                    <div class="hint">
                        @forelse ($missionsByType as $type => $count)
                            {{ $count }} {{ $type === 'quiz' ? 'kuis' : ($type === 'building' ? 'cari gedung' : $type) }}@if (! $loop->last), @endif
                        @empty
                            Belum ada misi
                        @endforelse
                    </div>
                </div>
                <div class="stat s-ink">
                    <div class="label">Lencana</div>
                    <div class="value">{{ number_format($totalBadges) }}</div>
                    <div class="hint">Bisa diraih pemain</div>
                </div>
            </section>

            <div class="dash-grid">
                <section class="panel" aria-labelledby="board-title">
                    <div class="panel-head">
                        <h2 id="board-title">Leaderboard</h2>
                        <a href="{{ route('admin.users') }}">Semua pengguna</a>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="board">
                            <thead>
                                <tr>
                                    <th scope="col">Peringkat</th>
                                    <th scope="col">Pemain</th>
                                    <th scope="col" class="col-level">Level</th>
                                    <th scope="col">Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leaderboard as $user)
                                    <tr>
                                        <td><span class="rank {{ $loop->iteration <= 3 ? 'r' . $loop->iteration : '' }}">{{ $loop->iteration }}</span></td>
                                        <td>
                                            <div class="person">
                                                <div class="avatar" aria-hidden="true">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                                <div>
                                                    <b>{{ $user->name }}</b>
                                                    <small>{{ $user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-level"><span class="lvl">Level {{ $user->level }}</span></td>
                                        <td class="pts">{{ number_format($user->total_points) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="empty">Belum ada pemain. Poin akan muncul di sini setelah ada yang menyelesaikan misi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <aside class="panel">
                    <figure class="side-photo">
                        <img src="{{ asset('img/administrasi-niaga.jpg') }}" alt="Gedung Administrasi Niaga dilihat dari atas" width="1800" height="961">
                        <figcaption>Politeknik Negeri Bengkalis</figcaption>
                    </figure>
                    <div class="side-body">
                        <h2>Kelola konten</h2>
                        <p>Tambah misi baru, atur lencana, atau perbarui lokasi.</p>
                        <div class="quick">
                            <a class="primary" href="{{ route('admin.missions.create') }}">Tambah misi <span>Gedung atau kuis</span></a>
                            <a href="{{ route('admin.missions.index') }}">Daftar misi <span>{{ $totalMissions }}</span></a>
                            <a href="{{ route('admin.badges.index') }}">Lencana <span>{{ $totalBadges }}</span></a>
                            <a href="{{ route('admin.locations.index') }}">Lokasi <span>{{ $totalLocations }}</span></a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
</body>
</html>
