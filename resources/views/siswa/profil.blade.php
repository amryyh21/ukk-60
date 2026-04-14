@extends('layouts.sideSiswa')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Profil Siswa</h4>
        <div class="d-flex gap-2">
            <button class="btn btn-light rounded-circle shadow-sm"><i class="bi bi-bell"></i></button>
            <button class="btn btn-light rounded-circle shadow-sm"><i class="bi bi-gear"></i></button>
        </div>
    </div>

    <div class="card card-profile p-4">
        <div class="row align-items-center text-center text-md-start">
            <div class="col-md-9">
                <h2 class="fw-bold mb-1">{{ $user->name }}</h2>
                <p class="text-info fw-semibold mb-1">{{ $user->kelas ?: 'Kelas belum diatur' }}</p>
                <p class="text-muted small">ID Siswa: {{ $user->nis_nip }} | Bergabung {{ $user->created_at?->translatedFormat('M Y') }}</p>

                <div class="row mt-4">
                    <div class="col-4">
                        <div class="p-3 text-center rounded-4 shadow-sm" style="background-color: #f0faff;">
                            <h4 class="fw-bold mb-0">{{ $totalReports }}</h4>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Laporan</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 text-center rounded-4 shadow-sm" style="background-color: #f0fff4;">
                            <h4 class="fw-bold mb-0 text-success">{{ $completedCount }}</h4>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Selesai</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 text-center rounded-4 shadow-sm" style="background-color: #fff9f0;">
                            <h4 class="fw-bold mb-0 text-warning">{{ $processCount }}</h4>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Proses</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-md-end mt-4 mt-md-0">
                <button class="btn btn-info text-white px-4 py-2 rounded-pill shadow-sm fw-bold" style="background-color: #00bee7; border:none;">
                    Edit Profil
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-profile p-4">
                <h5 class="fw-bold mb-4">Informasi Akun</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Email</label>
                        <p class="fw-semibold">{{ $user->email ?: '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">NIS</label>
                        <p class="fw-semibold">{{ $user->nis_nip }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Nomor Telepon</label>
                        <p class="fw-semibold">{{ $user->telp ?: '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
