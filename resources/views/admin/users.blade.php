<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container mt-4">
        <h3>Manajemen Pengguna (Mahasiswa)</h3>
        <div class="card mt-3">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Total Poin</th>
                            <th scope="col">Bergabung Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->total_points }}</td>
                                <td>{{ $student->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
