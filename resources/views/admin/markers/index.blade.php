<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penanda Navigasi - GamiCampus AR</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
</head>
<body class="brand">
    @include('admin.partials.navbar')

    <main class="admin-main">
        <div class="wrap">
            <div class="page-head">
                <div>
                    <h1>Penanda navigasi</h1>
                    <p>Gambar yang dipindai kamera untuk menentukan posisi awal di peta kampus.</p>
                </div>
                <a class="btn-brand indigo" href="{{ route('admin.markers.sheet') }}" target="_blank" rel="noopener">Buka semua lembar cetak (PDF)</a>
            </div>

            <section class="marker-intro" aria-label="Petunjuk pemasangan">
                <div>
                    <h2>Sebelum mencetak</h2>
                    <ul>
                        <li>Cetak <b>skala 100%</b> (bukan Fit to page) hingga sisi gambar tepat <b>{{ $sizeCm }} cm</b>. Garis ukur ada di tiap lembar.</li>
                        <li>Tempel <b>tegak di dinding</b>, pusat gambar <b>{{ str_replace('.', ',', $heightM) }} m</b> dari lantai, tanda ATAS ke atas.</li>
                        <li>Pakai kertas doff dan hindari area yang memantulkan cahaya.</li>
                        <li>Nama gambar harus sama dengan nama di aplikasi, jadi jangan diganti.</li>
                    </ul>
                </div>
            </section>

            <div class="marker-grid">
                @foreach ($markers as $nama => $m)
                    <article class="marker-card">
                        <div class="pic">
                            <img src="{{ route('admin.markers.preview', $nama) }}" alt="Penanda {{ $m['judul'] }}" width="560" height="560" loading="lazy">
                            <span class="page">Halaman {{ $m['halaman'] }}</span>
                        </div>
                        <div class="body">
                            <h3>{{ $m['judul'] }}</h3>
                            <code>{{ $nama }}</code>
                            <p>{{ $m['lokasi'] }}</p>
                            <div class="actions">
                                <a class="btn-brand indigo small" href="{{ route('admin.markers.sheet') }}#page={{ $m['halaman'] }}" target="_blank" rel="noopener">Lembar cetak</a>
                                <a class="btn-brand line-dark small" href="{{ route('admin.markers.image', $nama) }}">Unduh PNG</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </main>
</body>
</html>
