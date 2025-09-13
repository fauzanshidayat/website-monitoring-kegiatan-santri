<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo nurul alami.png') }}" type="image/x-icon">
    <title>Simkes Nurul Alami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .left-side {
            background-color: #067344;
            position: relative;
            color: white;
            overflow: hidden;
        }

        .left-side img.bg-img {
            opacity: 0.6;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .left-content {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            max-width: 300px;
        }

        .left-content h2 {
            color: #fbbf24;
            /* yellow-500 */
            font-weight: 800;
            font-size: 2rem;
        }

        .left-content p:first-of-type {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .left-content p:last-of-type {
            font-weight: 700;
            font-size: 0.875rem;
        }

        .nav-link {
            color: white !important;
            font-size: 0.875rem;
        }

        .nav-link i {
            margin-right: 0.25rem;
        }

        .right-side {
            padding: 4rem 2.5rem;
        }

        .form-control {
            padding-right: 2.5rem;
        }

        .input-icon {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
        }

        @media (max-width: 767.98px) {
            .left-side {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid vh-100 d-flex p-0">
        <div class="left-side col-md-8 d-none d-md-block position-relative">
            <nav class="navbar navbar-expand p-3">
                <div class="container-fluid px-4">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('home') }}">
                                <i class="fas fa-home"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://shorturl.at/BYi5I" target="_blank">Pendaftaran Santri
                                Baru</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <img alt="Front view of a university building with multiple windows and a tiled roof" class="bg-img"
                src="assets/images/profile.jpg" />
            <div class="left-content">
                <h2>Selamat Datang Di</h2>
                <h4>Sistem Informasi Monitoring Kegiatan Santri</h4>
                <h5>Pondok Pesantren Modern Nurul Alami</h5>
            </div>
        </div>
        <div class="right-side col-12 col-md-4 d-flex flex-column align-items-center justify-content-center bg-white">
            <img alt="Logo Pondok" class="mb-4" height="100" src="assets/images/logo nurul alami.png"
                width="100" />
            <p class="text-center text-secondary mb-4">Masuk untuk memulai sesi Anda</p>
            @if ($errors->any())
                <div>{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="" class="w-100 px-3" style="max-width: 350px;">
                @csrf
                <div class="mb-3 position-relative">
                    <input aria-label="Email" class="form-control" placeholder="Username" name="username"
                        type="text" />
                    <i class="fas fa-envelope input-icon"></i>
                </div>
                <div class="mb-3 position-relative">
                    <input aria-label="Password" class="form-control" placeholder="Password" name="password"
                        type="password" />
                    <i class="fas fa-lock input-icon"></i>
                </div>
                <button class="btn btn-primary d-flex align-items-center" type="submit">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
