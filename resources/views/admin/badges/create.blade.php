{{-- resources/views/admin/badges/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Lencana Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container mt-4">
        <h3>Tambah Lencana Baru</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.badges.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lencana:</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lencana">
                    </div>
                    <div class="mb-3">
                        <label for="icon_url" class="form-label">URL Ikon:</label>
                        <input type="text" name="icon_url" class="form-control"
                            placeholder="https://example.com/icon.png">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('admin.badges.index') }}"> Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
