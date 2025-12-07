<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.5rem;
        }

        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); color: #0dcaf0; }

        .table thead th {
            font-weight: 600;
            color: #6c757d;
            border-bottom-width: 1px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #495057;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark">Dashboard Overview</h2>
                <p class="text-muted">Welcome back, here's what's happening today.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Total Pengguna</p>
                                <h3 class="fw-bold mb-0">{{ $totalUsers }}</h3>
                            </div>
                            <div class="icon-box bg-soft-primary">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-soft-primary rounded-pill">Mahasiswa</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Misi Selesai</p>
                                <h3 class="fw-bold mb-0">{{ $missionsCompleted }}</h3>
                            </div>
                            <div class="icon-box bg-soft-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-soft-success rounded-pill">+12% Increase</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">Lencana Tersedia</p>
                                <h3 class="fw-bold mb-0">{{ $totalBadges }}</h3>
                            </div>
                            <div class="icon-box bg-soft-info">
                                <i class="fas fa-medal"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-soft-info rounded-pill">Achievements</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Top Leaderboard</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="ps-4">Rank</th>
                                <th scope="col">Mahasiswa</th>
                                <th scope="col">Level</th>
                                <th scope="col">Total Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaderboard as $user)
                                <tr>
                                    <td class="ps-4">
                                        @if($loop->iteration == 1)
                                            <span class="badge bg-warning text-dark"><i class="fas fa-crown me-1"></i> #1</span>
                                        @elseif($loop->iteration == 2)
                                            <span class="badge bg-secondary"><i class="fas fa-medal me-1"></i> #2</span>
                                        @elseif($loop->iteration == 3)
                                            <span class="badge" style="background-color: #cd7f32;"><i class="fas fa-medal me-1"></i> #3</span>
                                        @else
                                            <span class="fw-bold text-muted">#{{ $loop->iteration }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-primary border border-primary">Level {{ $user->level }}</span>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        {{ number_format($user->total_points) }} pts
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block opacity-50"></i>
                                        Belum ada data pengguna yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
