@extends('layouts.sideAdmin')
@section('content')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0">Manajemen Laporan Siswa</h4>
            <a href="{{ route('addKategori') }}" class="btn btn-info text-white px-4 py-2 rounded-3 shadow-sm">
                Kelola Kategori
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-container shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr class="text-muted small uppercase">
                            <th>No</th>
                            <th>Pelapor</th>
                            <th>NIS</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-bold">{{ $report->user->name ?? '-' }}</td>
                                <td>{{ $report->user->nis_nip ?? '-' }}</td>
                                <td>{{ $report->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $report->judul_laporan }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->tgl_pengaduan)->translatedFormat('d M Y') }}</td>
                                <td>
                                    <span class="priority-badge {{ $report->status === '2' ? 'p-low' : ($report->status === '1' ? 'p-medium' : 'p-high') }}">
                                        {{ $report->status_label }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('manageAspirasi.status', $report) }}" method="POST" class="d-inline-flex gap-2 align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="0" @selected($report->status === '0')>Menunggu</option>
                                            <option value="1" @selected($report->status === '1')>Diproses</option>
                                            <option value="2" @selected($report->status === '2')>Selesai</option>
                                        </select>
                                        <button type="submit" class="btn btn-manage shadow-sm">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada laporan untuk dikelola.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
