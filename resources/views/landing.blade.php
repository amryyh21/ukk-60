<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPERLAH - Layanan Aspirasi dan Pengaduan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 800;
            color: #00a3e0;
        }

        .hero-section {
            background: linear-gradient(rgba(15, 47, 90, 0.7), rgba(15, 47, 90, 0.8)),
                url("{{ asset('image/image.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 120px 0;
            margin-top: 30px;
            border-radius: 20px;
            color: white;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-primary-custom {
            background-color: #00bee7;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
        }

        .btn-outline-custom {
            border: 2px solid #ffffff;
            color: white;
            padding: 10px 25px;
            font-weight: 600;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-top: -50px;
            transition: 0.3s;
            height: 100%;
        }

        .step-card {
            background: white;
            border: none;
            border-radius: 15px;
            padding: 40px 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            background: #e0f7ff;
            color: #00a3e0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .cta-section {
            background-color: #0d1b2a;
            color: white;
            padding: 60px 0;
            border-radius: 20px;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('image/logo.jpeg') }}" alt="Logo" height="62">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('landing') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#track-report">Track Report</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#alur-pengaduan">Alur</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-info text-white rounded-pill px-4" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <header class="hero-section">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-4">Layanan Pengaduan Sarana Sekolah</h1>
                    <p class="lead mb-5">Sampaikan laporan kerusakan fasilitas dengan mudah, cepat, dan transparan demi kenyamanan belajar mengajar.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom text-white rounded shadow">Buat Laporan Sekarang</a>
                        <a href="#alur-pengaduan" class="btn btn-outline-custom rounded">Pelajari Alur</a>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div id="track-report" class="container mb-5">
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <div class="text-info fw-bold mb-2">Laporan Masuk</div>
                    <h2 class="fw-bold">{{ number_format($totalReports) }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center border-bottom border-success border-4">
                    <div class="text-success fw-bold mb-2">Masalah Teratasi</div>
                    <h2 class="fw-bold">{{ $completionRate }}%</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center border-bottom border-primary border-4">
                    <div class="text-primary fw-bold mb-2">Siswa Aktif</div>
                    <h2 class="fw-bold">{{ number_format($activeStudents) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <section class="container my-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="icon-box"><span class="fw-bold">#</span></div>
                    <h5 class="fw-bold">Kategori Terhubung</h5>
                    <p class="text-muted small">Jumlah kategori ini langsung mengikuti data dari panel admin.</p>
                    <h3 class="fw-bold text-info">{{ $categoryCount }}</h3>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="step-card">
                    <h5 class="fw-bold mb-3">Laporan Terbaru</h5>
                    @forelse ($recentReports as $report)
                        <div class="d-flex justify-content-between align-items-start border-bottom py-3">
                            <div>
                                <div class="fw-semibold">{{ $report->judul_laporan }}</div>
                                <div class="small text-muted">{{ $report->user->name ?? '-' }} • {{ $report->kategori->nama_kategori ?? '-' }}</div>
                            </div>
                            <span class="badge rounded-pill {{ $report->status === '2' ? 'bg-success' : ($report->status === '1' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                {{ $report->status_label }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">Belum ada laporan yang masuk.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section id="alur-pengaduan" class="container my-5 py-5">
        <div class="text-center mb-5">
            <span class="badge bg-info-subtle text-info p-2 px-3 rounded-pill mb-3">Info</span>
            <h2 class="fw-bold">Alur Pengaduan</h2>
            <p class="text-muted">Ikuti 3 langkah mudah untuk melaporkan kerusakan fasilitas dan pantau statusnya secara realtime.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="step-card">
                    <div class="icon-box">1</div>
                    <h5 class="fw-bold">1. Tulis Laporan</h5>
                    <p class="text-muted small">Login ke akun anda, lalu deskripsikan masalah kerusakan fasilitas secara jelas dan sertakan foto jika ada.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <div class="icon-box">2</div>
                    <h5 class="fw-bold">2. Verifikasi</h5>
                    <p class="text-muted small">Admin sekolah akan memverifikasi laporan yang masuk dan memperbarui statusnya melalui panel admin.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <div class="icon-box">3</div>
                    <h5 class="fw-bold">3. Tindak Lanjut</h5>
                    <p class="text-muted small">Laporan yang valid akan segera diproses, lalu hasilnya bisa dipantau kembali oleh siswa di dashboard dan history.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container mb-5">
        <div class="cta-section text-center">
            <h2 class="fw-bold mb-3">Siap Melaporkan Masalah?</h2>
            <p class="mb-4 text-secondary">Jangan biarkan fasilitas rusak mengganggu kegiatan belajar mengajar.<br>Mari berkontribusi untuk sekolah yang lebih baik.</p>
            <a href="{{ route('login') }}" class="btn btn-info text-white px-5 py-2 rounded shadow">Login & Lapor</a>
        </div>
    </div>

    <footer class="container py-4 border-top">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <a class="navbar-brand" href="{{ route('landing') }}">
                    <img src="{{ asset('image/logo1.png') }}" alt="Logo" height="62">
                </a>
            </div>
            <div class="col-md-6 text-center text-md-end small text-muted">
                <a href="#" class="text-decoration-none text-muted me-3">Privacy Policy</a>
                <a href="#" class="text-decoration-none text-muted me-3">Terms of Service</a>
                <a href="#" class="text-decoration-none text-muted">Contact Us</a>
                <p class="mt-2 mb-0">© 2026 LAPERLAH. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
