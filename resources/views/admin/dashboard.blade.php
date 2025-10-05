<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container mt-4">
        <h3>Dashboard Overview</h3>
        <hr>
        <div class="row">
            {{-- Card Total Pengguna --}}
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Pengguna (Mahasiswa)</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalUsers }}</h5>
                    </div>
                </div>
            </div>
            {{-- Card Misi Selesai --}}
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Misi Selesai</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $missionsCompleted }}</h5>
                    </div>
                </div>
            </div>
            {{-- Card Total Lencana --}}
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Total Lencana Tersedia</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalBadges }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Leaderboard --}}
        <div class="mt-4">
            <h3>Leaderboard</h3>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Rank</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Total Poin</th>
                                <th scope="col">Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaderboard as $user)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->total_points }}</td>
                                    <td>{{ $user->level }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
