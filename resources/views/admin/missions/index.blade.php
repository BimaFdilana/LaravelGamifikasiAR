{{-- resources/views/admin/missions/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Misi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Manajemen Misi</h3>
            <a href="{{ route('admin.missions.create') }}" class="btn btn-primary">Tambah Misi Baru</a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Poin</th>
                        <th>Hadiah Lencana</th>
                        <th width="280px">Aksi</th>
                    </tr>
                    @foreach ($missions as $mission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mission->title }}</td>
                            <td>{{ $mission->points_reward }}</td>
                            <td>{{ $mission->badge->name ?? 'Tidak ada' }}</td>
                            <td>
                                <form action="{{ route('admin.missions.destroy', $mission->id) }}" method="POST">
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('admin.missions.edit', $mission->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus misi ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $missions->links() !!}
            </div>
        </div>
    </div>
</body>

</html>
