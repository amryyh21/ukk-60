@extends('layouts.sideSiswa')
@section('content')
<div class="container-fluid p-0">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="35%">JUDUL</th>
                    <th width="15%">KATEGORI</th>
                    <th width="15%">STATUS</th>
                    <th width="15%">TANGGAL</th>
                    <th width="15%" class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->judul_laporan }}</td>
                        <td>{{ $report->kategori->nama_kategori ?? '-' }}</td>
                        <td>
                            <span class="badge badge-status {{ $report->status_badge_class }}">
                                {{ $report->status_label }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($report->tgl_pengaduan)->translatedFormat('d M Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-action" style="background-color: #6f42c1;" data-bs-toggle="modal" data-bs-target="#reportModal{{ $report->id }}">Detail</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada laporan yang dikirim.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @foreach ($reports as $report)
        <div class="modal fade" id="reportModal{{ $report->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $report->judul_laporan }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-2"><strong>Kategori:</strong> {{ $report->kategori->nama_kategori ?? '-' }}</p>
                        <p class="mb-2"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($report->tgl_pengaduan)->translatedFormat('d M Y') }}</p>
                        <p class="mb-2"><strong>Status:</strong> {{ $report->status_label }}</p>
                        @if ($report->foto)
                            <div class="mb-3">
                                <strong>Foto Bukti:</strong>
                                <div class="mt-2">
                                    <img src="{{ $report->foto_url }}" alt="Foto laporan" class="img-fluid rounded shadow-sm">
                                </div>
                            </div>
                        @endif
                        <p class="mb-0"><strong>Deskripsi:</strong><br>{{ $report->isi_laporan }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
