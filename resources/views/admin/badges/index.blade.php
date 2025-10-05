{{-- resources/views/admin/badges/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Lencana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Manajemen Lencana</h3>
            <a href="{{ route('admin.badges.create') }}" class="btn btn-primary">Tambah Lencana Baru</a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Icon</th>
                        <th>Nama Lencana</th>
                        <th width="280px">Aksi</th>
                    </tr>
                    @foreach ($badges as $badge)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ $badge->icon_url }}" alt="{{ $badge->name }}" width="50"></td>
                            <td>{{ $badge->name }}</td>
                            <td>
                                <form action="{{ route('admin.badges.destroy', $badge->id) }}" method="POST">
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('admin.badges.edit', $badge->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $badges->links() !!}
            </div>
        </div>
    </div>
</body>

</html>
