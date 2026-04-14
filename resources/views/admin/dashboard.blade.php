@extends('layouts.sideAdmin')
@section('content')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0">Admin Management Dashboard</h4>
            <div class="d-flex gap-3 align-items-center">
                <span class="text-muted small">Total laporan siswa terhubung real-time</span>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card-stat">
                    <small class="text-muted">Total Reports</small>
                    <h3 class="fw-bold">{{ $totalReports }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <small class="text-muted">Reports to Verify</small>
                    <h3 class="fw-bold">{{ $verifyCount }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <small class="text-muted">In Progress</small>
                    <h3 class="fw-bold">{{ $inProgressCount }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <small class="text-muted">Completion Rate</small>
                    <h3 class="fw-bold">{{ $completionRate }}%</h3>
                </div>
            </div>
        </div>

        <div class="table-container shadow-sm">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-1">Laporan Terbaru Siswa</h5>
                    <small class="text-muted">Laporan dari siswa yang nantinya akan memengaruhi dashboard dan history mereka</small>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('manageAspirasi') }}" class="btn btn-manage shadow-sm">Kelola Semua Laporan</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr class="text-muted small uppercase">
                            <th>ID</th>
                            <th>Reporter</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentReports as $report)
                            <tr>
                                <td class="fw-bold text-info">#RPT-{{ str_pad((string) $report->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="fw-bold">{{ $report->user->name ?? '-' }}</td>
                                <td>{{ $report->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $report->judul_laporan }}</td>
                                <td>
                                    <span class="priority-badge {{ $report->status === '2' ? 'p-low' : ($report->status === '1' ? 'p-medium' : 'p-high') }}">
                                        {{ $report->status_label }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ \Carbon\Carbon::parse($report->tgl_pengaduan)->translatedFormat('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada laporan dari siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
