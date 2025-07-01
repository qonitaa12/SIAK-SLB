<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Informasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-mini.svg') }}" type="image/svg+xml" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link href="https://cdn.materialdesignicons.com/7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #2a5298;
        }
        .logo {
            max-width: 90px;
        }
        .btn-primary {
            background-color: #2a5298;
            border: none;
        }
        .btn-primary:hover {
            background-color: #24477e;
        }
        .show-hide {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <!-- Logo -->
    <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="logo mb-3">

    <!-- Judul -->
    <i class="mdi mdi-lock-outline" style="font-size: 48px; color: #2a5298;"></i>
    <h4 class="fw-bold mt-2 mb-4">Login ke Sistem</h4>

    <!-- Error -->
    @if($errors->any())
        <div class="alert alert-danger text-start">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <div class="mb-3 text-start">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                <input type="text" id="username" name="username" class="form-control" required autofocus>
            </div>
        </div>

        <div class="mb-3 text-start">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-lock"></i></span>
                <input type="password" id="password" name="password" class="form-control" required>
                <span class="input-group-text show-hide" onclick="togglePassword()">
                    <i id="toggleIcon" class="mdi mdi-eye-outline"></i>
                </span>
            </div>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">
                <i class="mdi mdi-login me-1"></i> Login
            </button>
        </div>
    </form>

    <div class="text-muted small mt-3">
        &copy; {{ date('Y') }} Sistem Informasi Sekolah
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const input = document.getElementById("password");
        const icon = document.getElementById("toggleIcon");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("mdi-eye-outline");
            icon.classList.add("mdi-eye-off-outline");
        } else {
            input.type = "password";
            icon.classList.remove("mdi-eye-off-outline");
            icon.classList.add("mdi-eye-outline");
        }
    }
</script>

</body>
</html>
