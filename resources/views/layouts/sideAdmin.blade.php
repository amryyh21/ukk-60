<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Laperlah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --main-bg: #F4F7F6;
            --primary-blue: #24B6E9;
        }

        body {
            background-color: var(--main-bg);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: white;
            padding: 2rem 1.2rem;
            border-right: 1px solid #eef2f6;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .nav-link {
            color: #6c757d;
            font-weight: 500;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.3rem;
        }

        .nav-link.active {
            background-color: #E2F6FD;
            color: var(--primary-blue);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }

        .card-stat {
            border: none;
            border-radius: 16px;
            padding: 1.5rem;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .table-container {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
        }

        .priority-badge {
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .p-high {
            background: #FFE5E5;
            color: #FF4D4D;
        }

        .p-medium {
            background: #FFF4E5;
            color: #FF9900;
        }

        .p-low {
            background: #E6F9F1;
            color: #00B69B;
        }

        .btn-manage {
            background-color: var(--primary-blue);
            color: white;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 16px;
            border: none;
        }

        .input-custom {
            background-color: #f8f9fa;
            border: none;
            padding: 12px;
        }

        .btn-next {
            background-color: #24B6E9;
            color: white;
            border: none;
            font-weight: bold;
        }

        .btn-next:hover {
            background-color: #1da1d1;
        }

        .badge-status {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-selesai {
            background: #E6F9F1;
            color: #00B69B;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="brand mb-4 px-2">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('image/logo.jpeg') }}" alt="Logo" height="72">
            </a>
        </div>

        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}" href="{{ route('dashboard.admin') }}">Dashboard</a>
            <a class="nav-link {{ request()->routeIs('manageAspirasi*') ? 'active' : '' }}" href="{{ route('manageAspirasi') }}">All Reports</a>
            <a class="nav-link {{ request()->routeIs('manajemenSiswa') ? 'active' : '' }}" href="{{ route('manajemenSiswa') }}">Users Management</a>
            <a class="nav-link {{ request()->routeIs('addKategori*') ? 'active' : '' }}" href="{{ route('addKategori') }}">Category Management</a>
        </nav>

        <div class="user-profile mt-auto p-3 border rounded-4 bg-light">
            <div class="d-flex align-items-center mb-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'Admin') }}&background=E2F6FD&color=24B6E9"
                    class="rounded-circle me-2" width="38">
                <div class="overflow-hidden">
                    <p class="mb-0 fw-bold small text-truncate">{{ $user->name ?? 'Admin' }}</p>
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
