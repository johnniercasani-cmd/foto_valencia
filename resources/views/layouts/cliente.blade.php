<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Foto Valencia')</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6f8;
            color: #0f172a;
        }

        .navbar-cliente {
            height: 85px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .brand-cliente {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            text-decoration: none;
        }

        .nav-cliente {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-cliente a,
        .nav-cliente button {
            text-decoration: none;
            color: #0f172a;
            font-size: 18px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .btn-dark {
            background: #1f2937 !important;
            color: white !important;
            padding: 14px 24px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: #2563eb !important;
            color: white !important;
            padding: 14px 24px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-white {
            background: white;
            color: #0f172a;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }

        .hero {
            background: #e5e7eb;
            min-height: 620px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 60px;
            padding: 70px 35px;
        }

        .hero h1 {
            font-size: 58px;
            line-height: 1.1;
            margin-bottom: 28px;
            color: #0f172a;
        }

        .hero p {
            font-size: 22px;
            line-height: 1.6;
            color: #334155;
            max-width: 720px;
            margin-bottom: 35px;
        }

        .hero-actions {
            display: flex;
            gap: 20px;
        }

        .image-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }

        .hero-image {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 15px;
            background: #d1d5db;
        }

        .section {
            padding: 60px 35px;
            background: white;
        }

        .section-title {
            font-size: 38px;
            margin-bottom: 35px;
            text-align: center;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .service-card {
            background: #f1f1f1;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .service-card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            background: #d1d5db;
        }

        .service-content {
            padding: 20px;
        }

        .service-content h3 {
            margin-top: 0;
            font-size: 22px;
        }

        .service-content p {
            color: #475569;
            line-height: 1.5;
        }

        .service-price {
            font-weight: bold;
            margin-top: 10px;
        }

        .contact-section {
            background: #e5e7eb;
            padding: 50px 35px;
            text-align: center;
        }
    </style>
</head>
<body>

    <nav class="navbar-cliente">
        <a href="{{ route('dashboard') }}" class="brand-cliente">
            Estudio Fotográfico Valencia
        </a>

        <div class="nav-cliente">
            <a href="{{ route('dashboard') }}">Inicio</a>
            <a href="#servicios">Servicios</a>
            <a href="{{ route('reservas.index') }}">Mis reservas</a>
            <a href="{{ route('profile.edit') }}">Cuenta</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-dark">Salir</button>
            </form>
        </div>
    </nav>

    @yield('content')

</body>
</html>