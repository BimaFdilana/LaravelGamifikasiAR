{{-- resources/views/admin/badges/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lencana Baru</title>
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

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        /* Styling Input Group agar terlihat menyatu */
        .input-group-text {
            background-color: #fff;
            border: 1px solid #ced4da;
            border-right: none;
            color: #6c757d;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-left: none;
            padding: 0.6rem 1rem;
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #86b7fe;
            border-left: 1px solid #86b7fe; /* Visual trick saat fokus */
        }

        .input-group:focus-within .input-group-text {
            border-color: #86b7fe;
        }
    </style>
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                {{-- Header Section --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold text-dark mb-1">Tambah Lencana</h3>
                        <p class="text-muted small mb-0">Buat lencana baru sebagai hadiah misi.</p>
                    </div>
                    <a href="{{ route('admin.badges.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                {{-- Error Alerts --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2 fs-5"></i>
                            <div>
                                <strong>Terjadi Kesalahan!</strong>
                                <ul class="mb-0 ps-3 mt-1 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Form Card --}}
                <div class="card p-3">
                    <div class="card-body">
                        <form action="{{ route('admin.badges.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label">Nama Lencana <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-certificate text-warning"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="Contoh: Sang Juara" value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="icon_url" class="form-label">URL Ikon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link text-info"></i></span>
                                    <input type="text" name="icon_url" class="form-control" placeholder="https://example.com/icon.png" value="{{ old('icon_url') }}" required>
                                </div>
                                <div class="form-text text-muted small">
                                    Pastikan link gambar dapat diakses secara publik (format .png atau .jpg disarankan).
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-2 shadow-sm fw-bold">
                                    <i class="fas fa-save me-2"></i> Simpan Lencana
                                </button>
                                <a class="btn btn-light py-2 text-muted" href="{{ route('admin.badges.index') }}">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
