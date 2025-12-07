{{-- resources/views/admin/badges/edit.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lencana</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
        .form-label { font-weight: 500; color: #495057; }
        .input-group-text { background-color: #fff; border-right: none; color: #6c757d; }
        .form-control { border-left: none; padding: 0.6rem 1rem; }
        .input-group > .form-control:focus { box-shadow: none; border-color: #ced4da; }
        .input-group > .input-group-text { border: 1px solid #ced4da; border-right: none; }
        .input-group > .form-control { border: 1px solid #ced4da; border-left: none; }
    </style>
</head>
<body>
    @include('admin.partials.navbar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold text-dark mb-1">Edit Lencana</h3>
                        <p class="text-muted small mb-0">Update informasi untuk: <strong>{{ $badge->name }}</strong></p>
                    </div>
                    <a href="{{ route('admin.badges.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card p-4">
                    <div class="card-body">
                        <form action="{{ route('admin.badges.update', $badge->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="form-label">Nama Lencana <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-certificate text-warning"></i></span>
                                    <input type="text" name="name" value="{{ old('name', $badge->name) }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="icon_url" class="form-label">URL Ikon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link text-info"></i></span>
                                    <input type="url" name="icon_url" value="{{ old('icon_url', $badge->icon_url) }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-4 text-center">
                                <p class="small text-muted mb-2">Preview Ikon Saat Ini:</p>
                                <img src="{{ $badge->icon_url }}" alt="Preview" style="height: 60px; width: 60px; object-fit: contain;" class="border rounded p-1">
                            </div>

                            <hr class="my-4">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-2 shadow-sm"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                                <a href="{{ route('admin.badges.index') }}" class="btn btn-light py-2">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
