<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamiCampus AR - Welcome</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #764ba2;
            --bs-secondary: #667eea;
        }
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 700;
        }
        .btn-primary {
            background: linear-gradient(45deg, var(--bs-primary), var(--bs-secondary));
            border: none;
            padding: 10px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            background: linear-gradient(45deg, var(--bs-secondary), var(--bs-primary));
        }
        .hero-section {
            background: linear-gradient(135deg, #e6e9f0 0%, #eef1f5 100%);
            padding: 100px 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        .feature-card {
            transition: box-shadow 0.3s, transform 0.3s;
            border: none;
            border-radius: 15px;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary" href="#">
                <i class="fas fa-compass me-2"></i>GamiCampus AR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('admin.login') }}" class="btn btn-outline-primary rounded-pill me-2">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="hero" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="badge bg-primary bg-opacity-75 mb-3 py-2 px-3 fw-bold">Eksplorasi Kampus Seru!</span>
                    <h1 class="display-4 fw-bold mb-4">
                        Temukan Misi dan Lencana <span class="text-primary">Augmented Reality</span>
                    </h1>
                    <p class="lead text-muted mb-5">
                        Ubah pengalaman orientasi dan eksplorasi kampus menjadi game yang interaktif dan penuh hadiah. Dapatkan poin dan naikkan level Anda!
                    </p>
                    <a href="#features" class="btn btn-outline-secondary btn-lg rounded-pill">Lihat Fitur</a>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <section id="features" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Fitur Utama Aplikasi</h2>
                <p class="text-muted lead">Rasakan pengalaman belajar dan eksplorasi yang belum pernah ada.</p>
            </div>
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card feature-card p-4 shadow-sm h-100">
                        <div class="text-primary mb-3">
                            <i class="fas fa-map-marker-alt fa-3x"></i>
                        </div>
                        <h5 class="fw-bold">Eksplorasi AR Interaktif</h5>
                        <p class="text-muted">Temukan marker Augmented Reality di lokasi kampus untuk menyelesaikan misi. Peta kampus Anda adalah arena bermain!</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card p-4 shadow-sm h-100">
                        <div class="text-success mb-3">
                            <i class="fas fa-medal fa-3x"></i>
                        </div>
                        <h5 class="fw-bold">Sistem Gamifikasi Lengkap</h5>
                        <p class="text-muted">Dapatkan poin, lencana (badges), dan naikkan level Anda setiap kali menyelesaikan tugas dan misi. Bersaing di Leaderboard.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card p-4 shadow-sm h-100">
                        <div class="text-info mb-3">
                            <i class="fas fa-mobile-alt fa-3x"></i>
                        </div>
                        <h5 class="fw-bold">Akses Data Real-time</h5>
                        <p class="text-muted">Lihat progres Anda, misi yang tersedia, dan statistik teman secara real-time langsung dari perangkat seluler Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>

   <section id="cta" class="py-5">
        <div class="container text-center">
            <div class="p-5 bg-light rounded-4 shadow-lg">
                <h2 class="fw-bold mb-3">Siap Menjadi Penjelajah Kampus Terbaik?</h2>
                <p class="lead mb-4 text-muted">Ayo bergabung dengan ribuan mahasiswa lain dan mulai petualangan AR Anda hari ini.</p>

                <div class="mt-4">
                    <p class="fw-bold mb-2">Download Aplikasi Sekarang!</p>
                    <a href="#" class="btn btn-dark btn-lg me-2 rounded-pill">
                        <i class="fab fa-google-play me-2"></i> Google Play
                    </a>
                    <a href="#" class="btn btn-dark btn-lg rounded-pill">
                        <i class="fab fa-apple me-2"></i> App Store
                    </a>
                </div>

            </div>
        </div>
    </section>

    <footer id="contact" class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} GamiCampus AR. All rights reserved.</p>
            <p class="small mt-1">
                <a href="#" class="text-white-50 text-decoration-none">Privacy Policy</a> |
                <a href="#" class="text-white-50 text-decoration-none">Terms of Service</a>
            </p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


