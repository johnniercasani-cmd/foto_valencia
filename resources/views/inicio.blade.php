<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudio Fotográfico Valencia</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6f8;
            color: #0f172a;
        }

        .navbar {
            height: 85px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .brand {
            font-size: 28px;
            font-weight: 800;
            text-decoration: none;
            color: #0f172a;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links a {
            text-decoration: none;
            color: #0f172a;
            font-size: 18px;
        }

        .btn-dark {
            background: #1f2937;
            color: white !important;
            padding: 14px 24px;
            border-radius: 8px;
        }

        .btn-primary {
            background: #2563eb;
            color: white !important;
            padding: 14px 24px;
            border-radius: 8px;
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

    <nav class="navbar">
        <a href="{{ route('inicio') }}" class="brand">
            Estudio Fotográfico Valencia
        </a>

        <div class="nav-links">
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="#servicios">Servicios</a>
            <a href="#galeria">Galería</a>
            <a href="#contacto">Contacto</a>

            @guest
                <a href="{{ route('login') }}" class="btn-dark">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn-primary">Registrarse</a>
            @endguest

            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">Mi cuenta</a>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <div>
            <h1>Capturamos tus mejores momentos</h1>

            <p>
                Reserva sesiones fotográficas familiares, personales o corporativas
                desde nuestra plataforma web de manera rápida y sencilla.
            </p>

            <div class="hero-actions">
                @auth
                    <a href="{{ route('reservas.create') }}" class="btn-primary">
                        Reservar ahora
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary">
                        Reservar ahora
                    </a>
                @endauth

                <a href="#servicios" class="btn-white">
                    Ver servicios
                </a>
            </div>
        </div>

        <div class="image-card">
            <img src="{{ asset('img/hero-estudio.jpg') }}" alt="Imagen del estudio fotográfico" class="hero-image">
        </div>
    </section>

    <section class="section" id="servicios">
    <h2 class="section-title">Nuestros Servicios</h2>

    <div class="services-grid" id="servicios-container">
        <p>Cargando servicios...</p>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const contenedor = document.getElementById('servicios-container');

        fetch('/api/servicios')
            .then(response => response.json())
            .then(resultado => {
                contenedor.innerHTML = '';

                if (!resultado.success || resultado.data.length === 0) {
                    contenedor.innerHTML = '<p>No hay servicios disponibles.</p>';
                    return;
                }

                resultado.data.forEach(servicio => {
                    const card = document.createElement('div');
                    card.classList.add('service-card');

                    card.innerHTML = `
                        <img src="${servicio.imagen}" alt="${servicio.nombre}">
                        <div class="service-content">
                            <h3>${servicio.nombre}</h3>
                            <p>${servicio.descripcion ?? 'Servicio fotográfico disponible.'}</p>
                            <p class="service-price">Desde S/ ${parseFloat(servicio.precio).toFixed(2)}</p>
                        </div>
                    `;

                    contenedor.appendChild(card);
                });
            })
            .catch(error => {
                console.error(error);
                contenedor.innerHTML = '<p>No se pudieron cargar los servicios.</p>';
            });
    });
</script>

    <section class="contact-section" id="contacto">
        <h2>Contacto</h2>
        <p>Reserva tu sesión fotográfica de manera rápida desde nuestra plataforma web.</p>
        <p><strong>Foto Valencia - Arequipa, Perú</strong></p>
    </section>

</body>
</html>