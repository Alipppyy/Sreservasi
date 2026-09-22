<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ElectroFix - Sistem Reservasi Servis')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #473bf0;
            --primary-hover: #3d31d4;
            --text-dark: #161c2d;
            --text-muted: #687083;
            --bg-light: #f4f7fa;
        }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            letter-spacing: -0.03em;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 12px 28px;
            font-weight: 600;
            font-family: 'Space Grotesk', sans-serif;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(71, 59, 240, 0.3);
        }
        .navbar {
            padding: 1.2rem 0;
            transition: background 0.3s ease;
        }
        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
        }
        /* Landing Page Absolute Navbar */
        .navbar-transparent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background: transparent !important;
        }
        .navbar-transparent .navbar-brand,
        .navbar-transparent .nav-link {
            color: rgba(255,255,255,0.9) !important;
        }
        .navbar-transparent .nav-link:hover {
            color: #fff !important;
        }

        /* Footer Styling */
        footer {
            border-top: 1px solid #eaeaea;
            padding-top: 5rem;
            padding-bottom: 2rem;
            font-size: 0.95rem;
        }
        footer h6 {
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
        }
        footer ul {
            list-style: none;
            padding-left: 0;
        }
        footer ul li {
            margin-bottom: 0.8rem;
        }
        footer a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        footer a:hover {
            color: var(--primary-color);
        }
        /* Alert overrides */
        .toast-container { position: fixed; top: 80px; right: 20px; z-index: 1055; }
    </style>
    @stack('styles')
</head>
<body>
    @php
        $isHome = request()->is('/');
    @endphp

    <nav class="navbar navbar-expand-lg {{ $isHome ? 'navbar-transparent' : 'navbar-light bg-white border-bottom' }}">
        <div class="container">
            <a class="navbar-brand {{ $isHome ? 'text-white' : 'text-dark' }}" href="{{ url('/') }}">
                ElectroFix.io
            </a>
            <button class="navbar-toggler {{ $isHome ? 'border-0' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="{{ $isHome ? 'filter: invert(1);' : '' }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ps-lg-4 fs-6 fw-medium">
                    <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Harga</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Dukungan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                </ul>
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('teknisi.dashboard') }}">Teknisi Dashboard</a></li>
                        @endif
                        <li class="nav-item ms-lg-3">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-{{ $isHome ? 'light' : 'danger' }} fw-bold px-4 py-2" style="border-radius: 8px;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link fw-semibold me-3" href="{{ route('login') }}">Login Pegawai</a></li>
                        <li class="nav-item">
                            <a href="{{ route('booking.form') }}" class="btn btn-primary shadow-sm px-4 py-2">Mulai Booking</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Global Alerts -->
    @if(session('success'))
        <div class="toast-container">
            <div class="toast show align-items-center text-bg-success border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-medium">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="toast-container">
            <div class="toast show align-items-center text-bg-danger border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-medium">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-md-7 mb-4 mb-md-0">
                    <h2 class="fw-bold mb-3">Berlangganan newsletter kami<br>untuk mendapatkan berita terbaru.</h2>
                </div>
                <div class="col-md-5">
                    <form class="d-flex gap-2 bg-white p-2 rounded-3 border">
                        <input type="email" class="form-control border-0 shadow-none ps-3" placeholder="Masukkan email Anda" required>
                        <button type="submit" class="btn btn-primary px-4">Subscribe <i class="bi bi-arrow-right ms-1"></i></button>
                    </form>
                </div>
            </div>
            
            <hr class="mb-5 text-muted opacity-25">

            <div class="row g-4 mb-5">
                <div class="col-6 col-lg-2 offset-lg-1">
                    <h6 class="fw-bold">Perusahaan</h6>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Press</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold">Layanan Utama</h6>
                    <ul>
                        <li><a href="#">Servis AC</a></li>
                        <li><a href="#">Servis Kulkas</a></li>
                        <li><a href="#">Mesin Cuci</a></li>
                        <li><a href="#">Elektronik Lainnya</a></li>
                        <li><a href="#">Harga</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold">Dukungan</h6>
                    <ul>
                        <li><a href="#">Bantuan Online</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Area Layanan</a></li>
                        <li><a href="#">Garansi Servis</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-bold">Legal</h6>
                    <ul>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Refund</a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-3">
                    <h6 class="fw-bold">Hubungi Kami</h6>
                    <ul class="fw-medium">
                        <li><a href="mailto:support@electrofix.io" class="text-primary">support@electrofix.io</a></li>
                        <li><a href="tel:+6281234567890" class="text-primary">+62-812-3456-7890</a></li>
                    </ul>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between pt-4 border-top">
                <p class="text-muted small mb-0">© 2026 Copyright, Hak Cipta Dilindungi, Dibuat dengan <i class="bi bi-suit-heart-fill text-success"></i></p>
                <div class="d-flex gap-3 text-muted">
                    <a href="#" class="text-muted"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-primary"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto dismiss toast
        document.addEventListener('DOMContentLoaded', function () {
            var toasts = document.querySelectorAll('.toast');
            if(toasts.length) {
                var toastElList = [].slice.call(toasts)
                var toastList = toastElList.map(function (toastEl) {
                    return new bootstrap.Toast(toastEl, {delay: 5000})
                });
                toastList.forEach(toast => toast.show());
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
