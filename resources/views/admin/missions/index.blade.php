<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Misi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
        .table thead th { background-color: #f8f9fa; font-weight: 600; color: #6c757d; text-transform: uppercase; font-size: 0.8rem; border-bottom: 2px solid #e9ecef; padding: 1rem; }
        .mission-icon { width: 40px; height: 40px; background-color: #e0f2fe; color: #0ea5e9; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-right: 15px; }
        .btn-action { width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; transition: all 0.2s; }
        .btn-action:hover { transform: translateY(-2px); }
        .badge-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }
        .badge-soft-purple { background-color: rgba(111, 66, 193, 0.15); color: #6f42c1; }
        .badge-type { font-size: 0.75rem; padding: 0.35em 0.65em; font-weight: 600; }
    </style>
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Manajemen Misi</h3>
                <p class="text-muted small mb-0">Atur daftar misi, tipe, dan hadiah untuk mahasiswa.</p>
            </div>
            <a href="{{ route('admin.missions.create') }}" class="btn btn-primary shadow-sm rounded-3 px-4">
                <i class="fas fa-plus me-2"></i>Tambah Misi
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="ps-4">No</th>
                                <th scope="col">Judul Misi</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Reward Poin</th>
                                <th scope="col">Hadiah Lencana</th>
                                <th scope="col" class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($missions as $mission)
                                <tr>
                                    <td class="ps-4 fw-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mission-icon">
                                                @if($mission->type == 'book') <i class="fas fa-book"></i>
                                                @elseif($mission->type == 'building') <i class="fas fa-building"></i>
                                                @elseif($mission->type == 'quiz') <i class="fas fa-question-circle"></i>
                                                @else <i class="fas fa-bullseye"></i> @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $mission->title }}</div>
                                                <small class="text-muted">Target: {{ $mission->target_image_name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary badge-type">{{ strtoupper($mission->type) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-soft-warning px-3 py-2 rounded-pill">
                                            <i class="fas fa-star me-1"></i> {{ $mission->points_reward }} Pts
                                        </span>
                                    </td>
                                    <td>
                                        @if($mission->badge)
                                            <span class="badge badge-soft-purple px-3 py-2 rounded-pill">
                                                <i class="fas fa-medal me-1"></i> {{ $mission->badge->name }}
                                            </span>
                                        @else
                                            <span class="text-muted small fst-italic">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.missions.edit', $mission->id) }}" class="btn btn-action btn-outline-info">
                                            <i class="fas fa-pencil-alt small"></i>
                                        </a>
                                        <form action="{{ route('admin.missions.destroy', $mission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-action btn-outline-danger">
                                                <i class="fas fa-trash-alt small"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <p class="mb-0 text-muted">Belum ada misi yang ditambahkan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($missions->hasPages())
                <div class="card-footer bg-white py-3 border-0">
                    <div class="d-flex justify-content-center">{!! $missions->links() !!}</div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
