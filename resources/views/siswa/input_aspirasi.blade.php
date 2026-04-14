<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Laporan - Laperlah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f7f9; font-family: 'Inter', sans-serif; }
        .stepper-item { font-size: 0.8rem; font-weight: 600; color: #adb5bd; }
        .stepper-item.active { color: #24B6E9; }
        .card-custom { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-label { font-weight: 600; font-size: 0.9rem; }
        .input-custom { background-color: #f8f9fa; border: none; padding: 12px; }
        .btn-next { background-color: #24B6E9; color: white; border: none; font-weight: bold; }
        .btn-next:hover { background-color: #1da1d1; }
        .upload-area { border: 2px dashed #dee2e6; border-radius: 15px; padding: 30px; cursor: pointer; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-center gap-5 mb-5 text-center">
        <div class="stepper-item active"><i class="bi bi-1-circle-fill d-block fs-4"></i> Detail</div>
        <div class="stepper-item"><i class="bi bi-2-circle d-block fs-4"></i> Bukti</div>
        <div class="stepper-item"><i class="bi bi-3-circle d-block fs-4"></i> Tinjauan</div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card card-custom p-4">
                <h4 class="fw-bold mb-2">Kirim Laporan Baru</h4>
                <p class="text-muted small mb-4">Mohon berikan informasi detail mengenai masalah fasilitas agar kami dapat segera menanganinya.</p>

                <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Kategori Masalah <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-select input-custom @error('kategori_id') is-invalid @enderror">
                            <option selected disabled>Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('kategori_id') == $category->id)>{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Laporan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-light"><i class="bi bi-card-text"></i></span>
                            <input type="text" name="judul_laporan" class="form-control input-custom" value="{{ old('judul_laporan') }}" placeholder="Misal: Kursi rusak di kelas XII RPL 1">
                        </div>
                        @error('judul_laporan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="isi_laporan" class="form-control input-custom" rows="4" placeholder="Deskripsikan masalah secara detail...">{{ old('isi_laporan') }}</textarea>
                        @error('isi_laporan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 text-center">
                        <label class="form-label d-block text-start">Foto Bukti</label>
                        <div class="upload-area bg-light" onclick="document.getElementById('fileInput').click()">
                            <i class="bi bi-cloud-arrow-up fs-1 text-info"></i>
                            <p class="mb-0 mt-2 fw-semibold">Klik untuk unggah atau seret dan lepas</p>
                            <small class="text-muted">PNG, JPG, atau GIF (maks. 20MB)</small>
                            <input type="file" name="foto" id="fileInput" class="d-none" accept=".jpg,.jpeg,.png,.gif,image/jpeg,image/png,image/gif">
                        </div>
                        @error('foto')
                            <div class="text-danger small text-start mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.siswa') }}" class="btn btn-light w-50 fw-bold">Batal</a>
                        <button type="submit" class="btn btn-next w-50">Kirim Laporan</button>
                    </div>
                </form>
            </div>
            <p class="text-center mt-4 small text-muted">Mengalami kendala? <a href="#" class="text-info text-decoration-none fw-bold">Hubungi Dukungan</a></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
