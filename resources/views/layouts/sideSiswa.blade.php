<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laperlah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --main-bg: #F0F7F9;
            --primary-blue: #010202;
        }

        body {
            background-color: var(--main-bg);
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: white;
            padding: 2rem 1.5rem;
            border-right: 1px solid #eef2f6;
            display: flex;
            flex-direction: column;
        }

        .nav-link {
            color: #6c757d;
            font-weight: 500;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
        }

        .nav-link.active {
            background-color: #E2F6FD;
            color: var(--primary-blue);
        }

        .nav-link:hover:not(.active) {
            background-color: #f8f9fa;
        }

        .main-content {
            margin-left: 260px;
            /* Sesuaikan dengan lebar sidebar kamu */
            padding: 30px;
            min-height: 100vh;
            /* Gunakan min-height, bukan height */
            background-color: #f4f7f6;
            display: block;
            /* Pastikan tidak menggunakan flex center yang bikin konten ke tengah */
        }

        /* Stats Cards */
        .stat-card {
            border: none;
            border-radius: 15px;
            padding: 1.5rem;
            transition: transform 0.2s;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        /* Table Styling */
        .card-table {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .badge-status {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-diproses {
            background: #E0F4FF;
            color: #00A3FF;
        }

        .status-menunggu {
            background: #FFF4E5;
            color: #FF9900;
        }

        .status-selesai {
            background: #E6F9F1;
            color: #00B69B;
        }

        .search-container {
            position: relative;
        }

        .search-container i {
            position: absolute;
            left: 15px;
            top: 10px;
            color: #adb5bd;
        }

        .search-input {
            padding-left: 40px;
            border-radius: 10px;
            background-color: #f8f9fa;
            border: none;
        }

                body {
            background-color: #f8f9ff; /* Background agak kebiruan halus */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container-custom {
            padding-top: 50px;
        }
        /* Styling Search Bar */
        .search-input {
            border-radius: 20px;
            padding-left: 20px;
            width: 250px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        /* Styling Card Tabel */
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            overflow: hidden; /* Agar border radius terasa di header */
        }
        /* Header Tabel Biru */
        .table thead {
            background-color: #4e73df;
            color: white;
        }
        .table thead th {
            font-weight: 500;
            border: none;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f2f2f2;
        }
        /* Badge Status */
        .badge-waiting {
            background-color: #ffc107;
            color: #fff;
            border-radius: 20px;
            padding: 5px 15px;
            font-weight: normal;
        }
        /* Tombol Aksi */
        .btn-action {
            border-radius: 15px;
            padding: 5px 15px;
            font-size: 0.8rem;
            color: white !important;
        }

    </style>
</head>

<body>
    <div class="sidebar">
        <div class="brand mb-5 d-flex align-items-center">
            <div>
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('image/logo.jpeg') }}" alt="Logo" height="72">
                </a>
            </div>
        </div>

        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link active" href="{{ route('dashboard.siswa') }}"><i class=""></i> Dashboard</a>
            <a class="nav-link" href="{{ route('aspirasi') }}"><i ></i> New Report</a>
            <a class="nav-link" href="{{ route('history') }}"><i ></i> History Report</a>
            <a class="nav-link" href="{{ route('profil') }}"><i ></i> Profile</a>
        </nav>

        <div class="user-profile mt-auto p-3 border rounded-4 bg-light">
            <div class="d-flex align-items-center mb-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'Siswa') }}&background=random" class="rounded-circle me-2"
                    width="40">
                <div class="overflow-hidden">
                    <p class="mb-0 fw-bold small text-truncate">{{ $user->name ?? 'Siswa' }}</p>
                    <small class="text-muted d-block text-truncate">{{ $user->nis_nip ?? '-' }}</small>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
