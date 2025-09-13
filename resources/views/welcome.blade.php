<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo nurul alami.png') }}" type="image/x-icon">
    <title>Simkes Nurul Alami</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #067344;
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-brand span {
            color: #FFBB00;
        }

        .navbar a {
            color: #fff;
            margin-left: 1rem;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #FFBB00;
        }

        /* Hero Section */
        .hero {
            background-color: #067344;
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex-direction: column;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.3rem;
            margin: 20px 0;
            max-width: 600px;
        }

        .btn-login {
            background-color: #FFBB00;
            color: #067344;
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #e6aa00;
            color: #fff;
        }

        /* Responsive image */
        .hero img {
            max-width: 400px;
            width: 100%;
            margin-top: 30px;
        }

        /* Footer */
        footer {
            background-color: #065233;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">SIM<span>KES</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav">
                    <a class="nav-link" href="https://nurulalami.sch.id/">Home</a>
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="hero">
        <h1>Selamat Datang di SIMKES</h1>
        <p>Sistem Informasi Monitoring Kegiatan Santri - Pantau Kegiatan santri secara cepat
            dan mudah.</p>
        <a href="{{ route('login') }}" class="btn-login">Masuk ke SIMKES</a>

    </section>

    <!-- Footer -->
    <footer>
        &copy; 2025 PUSAKA Nurul Alami (Pusat Sistem dan Akses Komunikasi Pesantren).
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
