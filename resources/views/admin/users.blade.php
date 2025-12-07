<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
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
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .avatar-initials {
            width: 40px;
            height: 40px;
            background-color: #e0e7ff;
            color: #4f46e5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .table-hover tbody tr:hover {
            background-color: #fdfdfd;
            transform: scale(1.002);
            transition: all 0.2s ease;
        }
    </style>
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Manajemen Pengguna</h3>
                <p class="text-muted small mb-0">Kelola data mahasiswa dan poin pencapaian.</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari nama atau email...">
                        </div>
                    </div>
                    <div class="col-md-3 ms-auto">
                        <select class="form-select">
                            <option selected>Urutkan: Terbaru</option>
                            <option value="1">Poin Tertinggi</option>
                            <option value="2">Poin Terendah</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4">Mahasiswa</th>
                            <th scope="col">Total Poin</th>
                            <th scope="col">Bergabung Pada</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initials">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $student->name }}</div>
                                        <div class="small text-muted">{{ $student->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-2"></i>
                                    <span class="fw-bold">{{ number_format($student->total_points) }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $student->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Aktif</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="mb-2"><i class="fas fa-users-slash fa-3x opacity-50"></i></div>
                                Tidak ada data mahasiswa ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($students->hasPages())
            <div class="card-footer bg-white py-3 border-0">
                <div class="d-flex justify-content-center">
                    {{ $students->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
