<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laperlah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            height: 100 vh;
            margin: 0;
        }

        .login-container {
            min-height: 100vh;
        }

        /* Bagian Kiri: Gambar */
        .bg-image-side {
            background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)),
                url('https://lh3.googleusercontent.com/aida-public/AB6AXuDLBKJVWpEWzsBCiFKH7Afp1ohcD-2tP3-Nb6vzAhohTwKgyMDZ1nkznToVhTl2wEGrNPX-GvLxwS11r9ZYdP4TPEOQ-A2ioxR-QhNJrMbfOaFI4TcEFdZTSfssAIcf92k1qhl7OeXrGgFoUCq77T9OZivXk8vrFvgvKJzAByMPFc7N43E-N9L9jqckKfe9wBB2-3lE1x9RqEoZ0TBfjEHmJKDSZ_BuHrsP6ZAXYEsZTHnlk_vtx4-4uHKVKOoztR27ox0BCmXWEDe7');
            background-size: cover;
            background-position: center;
            position: relative;
        }



        /* Bagian Kanan: Form */
        .form-side {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
        }

        .login-form-width {
            width: 100%;
            max-width: 400px;
        }

        .brand-title {
            font-weight: 900;
            letter-spacing: -1px;
            font-size: 2.5rem;
        }

        .brand-subtitle {
            color: #50A5C1;
            font-weight: 500;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }

        .form-control {
            border-left: none;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            background-color: #fff;
            box-shadow: none;
            border-color: #dee2e6;
        }

        .btn-log-in {
            background-color: #24B6E9;
            border: none;
            padding: 12px;
            font-weight: bold;
            color: white;
            transition: 0.3s;
        }

        .btn-log-in:hover {
            background-color: #1da1d1;
        }

        .btn-outline-custom {
            border: 1px solid #dee2e6;
            color: #333;
            font-weight: 500;
            padding: 10px;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #adb5bd;
            margin: 2rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #eee;
        }

        .divider:not(:empty)::before {
            margin-right: .5em;
        }

        .divider:not(:empty)::after {
            margin-left: .5em;
        }
    </style>
</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0 login-container">
            <div class="col-md-6 d-none d-md-block bg-image-side">
            </div>

            <div class="col-md-6 form-side">
                <div class="login-form-width">
                    <div class="text-center mb-5">
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('image/logo.jpeg') }}" alt="Logo" height="102">
                        </a>
                        <p class="brand-subtitle">Report issues. Improve our campus.</p>
                    </div>

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">NIS / NIP</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person text-info"></i></span>
                                <input type="text" name="login_field" class="form-control"
                                    value="{{ old('login_field') }}" placeholder="Masukkan NIS atau NIP" required>
                            </div>
                        </div>

                        @if ($errors->has('login_field'))
                            <div class="alert alert-danger py-2 small">
                                {{ $errors->first('login_field') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock text-info"></i></span>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter your password">
                                <span class="input-group-text" style="border-left: none;"><i
                                        class="bi bi-eye"></i></span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label small text-muted" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none small text-info fw-bold">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-log-in w-100 mb-3">LOG IN</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
