
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Lokasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.partials.navbar')
    <div class="container mt-4">
        <h3>Edit Lokasi</h3>
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
                <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lokasi:</label>
                        <input type="text" name="name" value="{{ $location->name }}" class="form-control"
                            placeholder="Contoh: Perpustakaan">
                    </div>
                    <div class="mb-3">
                        <label for="marker_id" class="form-label">ID Marker:</label>
                        <input type="text" name="marker_id" value="{{ $location->marker_id }}" class="form-control"
                            placeholder="ID unik untuk AR, contoh: loc_perpustakaan">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi:</label>
                        <textarea class="form-control" style="height:100px" name="description" placeholder="Deskripsi singkat lokasi">{{ $location->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-secondary" href="{{ route('admin.locations.index') }}"> Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
