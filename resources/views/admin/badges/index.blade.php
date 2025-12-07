{{-- resources/views/admin/badges/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Lencana</title>
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

        .badge-preview {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 4px;
        }

        .btn-action {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .table-hover tbody tr:hover {
            background-color: #fdfdfd;
        }
    </style>
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Manajemen Lencana</h3>
                <p class="text-muted small mb-0">Kelola koleksi lencana dan ikon pencapaian.</p>
            </div>
            <a href="{{ route('admin.badges.create') }}" class="btn btn-primary shadow-sm rounded-3 px-4">
                <i class="fas fa-plus me-2"></i>Tambah Lencana
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="ps-4" width="60">No</th>
                                <th scope="col" width="100">Icon</th>
                                <th scope="col">Nama Lencana</th>
                                <th scope="col" class="text-end pe-4" width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($badges as $badge)
                                <tr>
                                    <td class="ps-4 fw-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $badge->icon_url }}"
                                             alt="{{ $badge->name }}"
                                             class="badge-preview shadow-sm"
                                             onerror="this.src='https://via.placeholder.com/50?text=Icon'">
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark">{{ $badge->name }}</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.badges.edit', $badge->id) }}"
                                               class="btn btn-action btn-outline-info"
                                               title="Edit Lencana">
                                                <i class="fas fa-pencil-alt small"></i>
                                            </a>

                                            <form action="{{ route('admin.badges.destroy', $badge->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-action btn-outline-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus lencana &quot;{{ $badge->name }}&quot;?')"
                                                        title="Hapus Lencana">
                                                    <i class="fas fa-trash-alt small"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-award fa-3x mb-3 opacity-50"></i>
                                            <p class="mb-0">Belum ada lencana yang ditambahkan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($badges->hasPages())
                <div class="card-footer bg-white py-3 border-0">
                    <div class="d-flex justify-content-center">
                        {!! $badges->links() !!}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
