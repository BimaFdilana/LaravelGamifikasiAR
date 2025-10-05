{{-- resources/views/admin/missions/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Misi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container mt-4">
        <h3>Tambah Misi Baru</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Terjadi kesalahan input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.missions.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">Judul Misi:</label>
                            <input type="text" name="title" class="form-control" placeholder="Judul Misi">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Deskripsi:</label>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Deskripsi"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="points_reward" class="form-label">Poin Hadiah:</label>
                            <input type="number" name="points_reward" class="form-control" placeholder="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="badge_reward_id" class="form-label">Hadiah Lencana (Opsional):</label>
                            <select name="badge_reward_id" class="form-control">
                                <option value="">Tidak Ada</option>
                                @foreach ($badges as $badge)
                                    <option value="{{ $badge->id }}">{{ $badge->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-secondary" href="{{ route('admin.missions.index') }}"> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
