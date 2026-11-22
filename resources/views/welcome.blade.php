@php
    $apkPath = public_path('downloads/ARPolbeng.apk');
    $apkReady = file_exists($apkPath);
    $apkSize = $apkReady ? number_format(filesize($apkPath) / 1048576, 0) . ' MB' : null;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamiCampus AR - Jelajah Kampus Polbeng</title>
    <meta name="description" content="Aplikasi Android untuk menjelajahi kampus Politeknik Negeri Bengkalis dengan augmented reality: cari gedung, jawab kuis, kumpulkan poin dan lencana.">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/brand.css') }}" rel="stylesheet">
</head>
<body class="brand">

    <header class="site-bar">
        <div class="wrap">
            <a href="#top" class="brand-mark">
                <img src="{{ asset('img/logo.png') }}" alt="Logo GamiCampus AR" width="42" height="42">
                <span>
                    <strong>GamiCampus AR</strong>
                    <small>Politeknik Negeri Bengkalis</small>
                </span>
            </a>
            <nav class="site-links" aria-label="Navigasi utama">
                <a href="#cara" class="hide-md">Cara main</a>
                <a href="#gedung" class="hide-md">Gedung</a>
                <a href="#fitur" class="hide-md">Fitur</a>
                <a href="{{ route('admin.login') }}" class="btn-brand indigo small">Masuk admin</a>
            </nav>
        </div>
    </header>

    <main id="top">
        <section class="hero">
            <div class="wrap">
                <div>
                    <span class="eyebrow">Aplikasi AR untuk Android</span>
                    <h1>Keliling kampus Polbeng, <em>selesaikan misinya.</em></h1>
                    <p class="lead">
                        GamiCampus AR mengubah pengenalan Politeknik Negeri Bengkalis menjadi permainan.
                        Cari gedung lewat kamera, jawab kuis kampus, lalu kumpulkan poin dan lencana.
                    </p>
                    <div class="hero-actions">
                        @if ($apkReady)
                            <a href="{{ asset('downloads/ARPolbeng.apk') }}" class="btn-brand amber" download>
                                <i class="fa-brands fa-android" aria-hidden="true"></i> Unduh APK Android
                            </a>
                        @else
                            <span class="btn-brand amber" aria-disabled="true">
                                <i class="fa-brands fa-android" aria-hidden="true"></i> APK segera tersedia
                            </span>
                        @endif
                        <a href="#cara" class="btn-brand line">Lihat cara main</a>
                    </div>
                    @if ($apkReady)
                        <p class="hero-note">ARPolbeng.apk &middot; {{ $apkSize }} &middot; izinkan instalasi dari sumber lain saat diminta.</p>
                    @endif
                </div>
                <figure class="hero-photo">
                    <img src="{{ asset('img/direktorat.jpg') }}" alt="Gedung Direktorat Politeknik Negeri Bengkalis dilihat dari depan" width="1800" height="902" fetchpriority="high">
                    <figcaption>Gedung Direktorat</figcaption>
                </figure>
            </div>
        </section>

        <section class="facts" aria-label="Kebutuhan perangkat">
            <div class="wrap">
                <div><b>Android 10 ke atas</b><span>Aplikasi dipasang lewat file APK</span></div>
                <div><b>Perangkat dengan ARCore</b><span>Kamera dipakai untuk memindai penanda gedung</span></div>
                <div><b>Perlu koneksi internet</b><span>Misi dan progres tersimpan di server kampus</span></div>
            </div>
        </section>

        <section class="section" id="cara">
            <div class="wrap">
                <div class="section-head">
                    <span class="eyebrow">Cara main</span>
                    <h2>Tiga langkah dari gerbang sampai leaderboard</h2>
                    <p>Setiap misi mengarahkan kamu ke satu titik di kampus. Selesaikan, dan poinnya langsung masuk.</p>
                </div>
                <div class="steps">
                    <article class="step">
                        <div class="num">01</div>
                        <h3>Masuk dengan akunmu</h3>
                        <p>Daftar atau masuk lewat aplikasi. Progres disimpan di server, jadi tidak hilang saat ganti HP.</p>
                    </article>
                    <article class="step">
                        <div class="num">02</div>
                        <h3>Temukan dan pindai gedung</h3>
                        <p>Datangi gedung yang diminta misi, lalu arahkan kamera ke penanda AR di lokasi.</p>
                    </article>
                    <article class="step">
                        <div class="num">03</div>
                        <h3>Jawab, kumpulkan, naik level</h3>
                        <p>Selesaikan kuis kampus, dapatkan poin dan lencana, lalu lihat posisimu di leaderboard.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section gallery-section" id="gedung">
            <div class="wrap">
                <div class="section-head">
                    <span class="eyebrow">Lokasi misi</span>
                    <h2>Gedung yang akan kamu cari</h2>
                    <p>Foto-foto ini dari kampus yang sama dengan yang kamu jelajahi di dalam aplikasi.</p>
                </div>
                <div class="gallery">
                    <figure class="tile w7">
                        <img src="{{ asset('img/teknik-elektro.jpg') }}" alt="Gedung Teknik Elektro beratap merah dengan panel surya" width="1800" height="964" loading="lazy">
                        <figcaption><b>Teknik Elektro</b><span>Misi pencarian gedung</span></figcaption>
                    </figure>
                    <figure class="tile w5">
                        <img src="{{ asset('img/teknik-informatika.jpg') }}" alt="Gedung Teknik Informatika dari atas, dengan halaman dan jalan setapak di depannya" width="1800" height="963" loading="lazy">
                        <figcaption><b>Teknik Informatika</b><span>Misi pencarian gedung</span></figcaption>
                    </figure>
                    <figure class="tile w5">
                        <img src="{{ asset('img/administrasi-niaga.jpg') }}" alt="Gedung Administrasi Niaga dengan fasad melengkung dan area parkir" width="1800" height="961" loading="lazy">
                        <figcaption><b>Administrasi Niaga</b><span>Misi pencarian gedung</span></figcaption>
                    </figure>
                    <figure class="tile w7">
                        <img src="{{ asset('img/direktorat.jpg') }}" alt="Fasad Gedung Direktorat dengan tulisan Politeknik Negeri Bengkalis" width="1800" height="902" loading="lazy">
                        <figcaption><b>Gedung Direktorat</b><span>Pusat administrasi kampus</span></figcaption>
                    </figure>
                </div>
            </div>
        </section>

        <section class="section" id="fitur">
            <div class="wrap">
                <div class="section-head">
                    <span class="eyebrow">Fitur</span>
                    <h2>Yang ada di dalam aplikasi</h2>
                </div>
                <div class="features">
                    <article class="feature">
                        <div class="ico i-indigo"><i class="fa-solid fa-building" aria-hidden="true"></i></div>
                        <h3>Pencarian gedung AR</h3>
                        <p>Pindai penanda di gedung yang dituju untuk menyelesaikan misi, tanpa perlu mengetik apa pun.</p>
                    </article>
                    <article class="feature">
                        <div class="ico i-amber"><i class="fa-solid fa-circle-question" aria-hidden="true"></i></div>
                        <h3>Kuis kampus</h3>
                        <p>Pertanyaan pilihan ganda tentang gedung dan lingkungan Polbeng, dengan poin untuk setiap jawaban benar.</p>
                    </article>
                    <article class="feature">
                        <div class="ico i-sky"><i class="fa-solid fa-route" aria-hidden="true"></i></div>
                        <h3>Navigasi kampus</h3>
                        <p>Peta kampus dan penunjuk arah ke ruangan, supaya tidak tersesat saat mencari lokasi misi.</p>
                    </article>
                    <article class="feature">
                        <div class="ico i-indigo"><i class="fa-solid fa-trophy" aria-hidden="true"></i></div>
                        <h3>Poin, lencana, leaderboard</h3>
                        <p>Naik level tiap misi selesai, kumpulkan lencana, dan bandingkan poinmu dengan teman.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="wrap">
                <div>
                    <h2>Siap keliling kampus?</h2>
                    <p>Pasang aplikasinya di HP Android, masuk, dan mulai dari misi pertama.</p>
                </div>
                <div class="cta-actions">
                    @if ($apkReady)
                        <a href="{{ asset('downloads/ARPolbeng.apk') }}" class="btn-brand indigo" download>
                            <i class="fa-brands fa-android" aria-hidden="true"></i> Unduh APK Android
                        </a>
                        <small>ARPolbeng.apk &middot; {{ $apkSize }}</small>
                    @else
                        <span class="btn-brand indigo" aria-disabled="true">APK segera tersedia</span>
                        <small>Tautan unduhan akan muncul di sini.</small>
                    @endif
                </div>
            </div>
        </section>
    </main>

    <footer class="site-foot">
        <div class="wrap">
            <span>&copy; {{ date('Y') }} GamiCampus AR &middot; Politeknik Negeri Bengkalis</span>
            <a href="{{ route('admin.login') }}">Masuk admin</a>
        </div>
    </footer>

</body>
</html>
