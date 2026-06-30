<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudio Fotográfico</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">
                Estudio Fotográfico Valencia
            </h1>

            <nav class="space-x-4">
                <a href="#" class="text-gray-700 hover:text-black">Inicio</a>
                <a href="#" class="text-gray-700 hover:text-black">Servicios</a>
                <a href="#" class="text-gray-700 hover:text-black">Galería</a>
                <a href="#" class="text-gray-700 hover:text-black">Contacto</a>

                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="bg-gray-800 text-white px-4 py-2 rounded-lg">
                        Iniciar sesión
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Registrarse
                    </a>
                @endif
            </nav>
        </div>
    </header>

    <section class="min-h-[80vh] flex items-center bg-gray-200">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

            <div>
                <h2 class="text-5xl font-bold mb-6">
                    Capturamos tus mejores momentos
                </h2>

                <p class="text-lg text-gray-700 mb-8">
                    Reserva sesiones fotográficas familiares, personales o corporativas
                    desde nuestra plataforma web de manera rápida y sencilla.
                </p>

                <div class="space-x-4">
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg">
                        Reservar ahora
                    </a>

                    <a href="#" class="bg-white text-gray-800 px-6 py-3 rounded-lg border">
                        Ver servicios
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="h-80 bg-gray-300 rounded-xl flex items-center justify-center">
                    <p class="text-gray-600">
                        Imagen del estudio fotográfico
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-16">
        <h3 class="text-3xl font-bold text-center mb-10">
            Nuestros servicios
        </h3>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-xl font-bold mb-3">Sesión Familiar</h4>
                <p class="text-gray-600">
                    Fotografías profesionales para familias y momentos especiales.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-xl font-bold mb-3">Sesión Personal</h4>
                <p class="text-gray-600">
                    Ideal para retratos, perfiles profesionales y redes sociales.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="text-xl font-bold mb-3">Sesión Corporativa</h4>
                <p class="text-gray-600">
                    Servicio fotográfico para empresas, equipos y eventos institucionales.
                </p>
            </div>
        </div>
    </section>

</body>
</html>