@extends('layouts.cliente')

@section('title', 'Inicio Cliente - Foto Valencia')

@section('content')
    <section class="hero">
        <div>
            <h1>Capturamos tus mejores momentos</h1>

            <p>
                Reserva sesiones fotográficas familiares, personales o corporativas
                desde nuestra plataforma web de manera rápida y sencilla.
            </p>

            <div class="hero-actions">
                <a href="{{ route('reservas.create') }}" class="btn-primary">
                    Reservar ahora
                </a>

                <a href="#servicios" class="btn-white">
                    Ver servicios
                </a>
            </div>
        </div>

        <div class="image-card">
            <img src="{{ asset('img/hero-estudio.jpg') }}"
                 alt="Imagen del estudio fotográfico"
                 class="hero-image">
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
@endsection