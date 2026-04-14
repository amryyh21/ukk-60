@extends('layouts.sideAdmin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Data Siswa</h2>
                <p class="text-muted">Kelola data siswa dan pantau jumlah laporan mereka.</p>
            </div>
        </div>

        <div class="table-container">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" width="28%">NAMA & NIS</th>
                        <th width="18%">KELAS</th>
                        <th width="20%">EMAIL</th>
                        <th width="14%">LAPORAN</th>
                        <th width="10%">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold" style="color: #1e293b;">{{ $student->name }}</div>
                                <small class="text-muted">NIS: {{ $student->nis_nip }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-3 fw-normal">
                                    {{ $student->kelas ?: 'Belum diatur' }}
                                </span>
                            </td>
                            <td>{{ $student->email ?: '-' }}</td>
                            <td>{{ $student->pengaduan_count }}</td>
                            <td>
                                <span class="badge-status status-selesai d-inline-flex align-items-center">
                                    <i class="bi bi-circle-fill me-2" style="font-size: 6px;"></i> Aktif
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
