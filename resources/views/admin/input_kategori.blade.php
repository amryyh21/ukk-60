@extends('layouts.sideAdmin')

@section('content')
    <div class="container-fluid p-0">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card card-stat">
                    <h4 class="fw-bold mb-3">Tambah kategori baru</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('addKategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kategori" class="form-control input-custom @error('nama_kategori') is-invalid @enderror"
                                value="{{ old('nama_kategori') }}" placeholder="Misal: Proyektor">
                            @error('nama_kategori')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('manageAspirasi') }}" class="btn btn-light w-50 fw-bold">Batal</a>
                            <button type="submit" class="btn btn-next w-50">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="table-container shadow-sm">
                    <h5 class="fw-bold mb-3">Daftar kategori</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Dibuat</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-bold">{{ $category->nama_kategori }}</td>
                                        <td>{{ $category->created_at?->translatedFormat('d M Y') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('addKategori.destroy', $category) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger shadow-sm px-3" type="submit">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada kategori.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
