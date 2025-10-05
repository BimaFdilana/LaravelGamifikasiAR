
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Lokasi AR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.partials.navbar')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Manajemen Lokasi AR</h3>
            <a href="{{ route('admin.locations.create') }}" class="btn btn-primary">Tambah Lokasi Baru</a>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama Lokasi</th>
                        <th>ID Marker</th>
                        <th width="280px">Aksi</th>
                    </tr>
                    @foreach ($locations as $location)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->marker_id }}</td>
                            <td>
                                <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST">
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('admin.locations.edit', $location->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $locations->links() !!}
            </div>
        </div>
    </div>
</body>

</html>
