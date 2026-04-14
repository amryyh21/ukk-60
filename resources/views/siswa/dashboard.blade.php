@extends('layouts.sideSiswa')

@section('content')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h2 class="fw-bold">Dashboard</h2>
                <p class="text-muted">Selamat datang, {{ $user->name }}</p>
            </div>
            <a href="{{ route('aspirasi') }}" class="btn btn-info text-white px-4 py-2 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> New Report
            </a>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm">
                    <div class="icon-box bg-warning-subtle text-warning">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                    <h6 class="text-muted mb-1">Pending</h6>
                    <h2 class="fw-bold mb-1">{{ $pendingCount }}</h2>
                    <small class="text-danger fw-bold">Needs attention</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm">
                    <div class="icon-box bg-info-subtle text-info">
                        <i class="bi bi-gear-fill fs-4"></i>
                    </div>
                    <h6 class="text-muted mb-1">In Progress</h6>
                    <h2 class="fw-bold mb-1">{{ $processCount }}</h2>
                    <small class="text-info fw-bold">Being fixed now</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm">
                    <div class="icon-box bg-success-subtle text-success">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                    </div>
                    <h6 class="text-muted mb-1">Completed</h6>
                    <h2 class="fw-bold mb-1">{{ $completedCount }}</h2>
                    <small class="text-success fw-bold">Successfully resolved</small>
                </div>
            </div>
        </div>

        <div class="card card-table p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Recent Reports</h5>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0">Issue Category</th>
                            <th class="border-0">Title</th>
                            <th class="border-0">Date</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentReports as $report)
                            <tr>
                                <td>{{ $report->kategori->nama_kategori ?? '-' }}</td>
                                <td class="text-muted">{{ $report->judul_laporan }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->tgl_pengaduan)->translatedFormat('d M Y') }}</td>
                                <td>
                                    <span class="badge badge-status {{ $report->status_badge_class }}">
                                        {{ $report->status_label }}
                                    </span>
                                </td>
                                <td><a href="{{ route('history') }}" class="text-info text-decoration-none fw-bold small">View Details</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada laporan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">Menampilkan {{ $recentReports->count() }} dari {{ $totalReports }} laporan</small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link px-3" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link px-3" href="{{ route('history') }}">History</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
