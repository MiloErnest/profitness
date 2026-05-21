@extends('layouts.app')

@section('title', 'Entrenamiento Online - Pro Fitness')

@section('content')
<!-- HERO SECTION -->
<section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white py-24">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-extrabold mb-6 uppercase tracking-widest">Entrenamiento Online</h1>
        <p class="text-xl max-w-2xl mx-auto text-white/90">
            Entrena donde quieras, cuando quieras. Llevamos Pro Fitness a tu hogar.
        </p>
    </div>
</section>

<!-- BENEFICIOS -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-700 mb-12 uppercase">¿Por qué elegir Online?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
            <div class="bg-gradient-to-b from-white to-red-50 border border-red-200 rounded-xl p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-red-700">Flexibilidad</h3>
                <p class="text-gray-600 text-sm">Entrena en el horario que mejor se adapte a tu rutina.</p>
            </div>
            <div class="bg-gradient-to-b from-white to-red-50 border border-red-200 rounded-xl p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-home text-xl"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-red-700">Comodidad</h3>
                <p class="text-gray-600 text-sm">Desde la comodidad de tu hogar, sin desplazamientos.</p>
            </div>
            <div class="bg-gradient-to-b from-white to-red-50 border border-red-200 rounded-xl p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-check text-xl"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-red-700">Personalizado</h3>
                <p class="text-gray-600 text-sm">Rutinas adaptadas a tus objetivos y nivel de experiencia.</p>
            </div>
            <div class="bg-gradient-to-b from-white to-red-50 border border-red-200 rounded-xl p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-video text-xl"></i>
                </div>
                <h3 class="text-lg font-bold mb-2 text-red-700">Videos HD</h3>
                <p class="text-gray-600 text-sm">Acceso a videos de alta calidad con instrucciones detalladas.</p>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAMAS -->
<section class="py-20 bg-gradient-to-b from-red-50 to-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-700 mb-12 uppercase">Nuestros Programas</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="bg-gradient-to-r from-red-500 to-red-700 text-white p-6">
                    <h3 class="text-2xl font-bold mb-2">Principiante</h3>
                    <p class="text-white/90">Ideal para quienes inician</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Rutinas básicas
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            3 sesiones semanales
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Seguimiento por chat
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Guía nutricional básica
                        </li>
                    </ul>
                    <a href="{{ route('contact') }}" class="block text-center bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                        Más Información
                    </a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform scale-105 border-2 border-red-500">
                <div class="bg-gradient-to-r from-red-600 to-red-800 text-white p-6">
                    <h3 class="text-2xl font-bold mb-2">Intermedio</h3>
                    <p class="text-white/90">Para quienes ya tienen experiencia</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Rutinas avanzadas
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            5 sesiones semanales
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Videollamadas semanales
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Plan nutricional personalizado
                        </li>
                    </ul>
                    <a href="{{ route('contact') }}" class="block text-center bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                        Más Información
                    </a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="bg-gradient-to-r from-red-500 to-red-700 text-white p-6">
                    <h3 class="text-2xl font-bold mb-2">Avanzado</h3>
                    <p class="text-white/90">Para atletas y competidores</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Rutinas de competición
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            6 sesiones semanales
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Seguimiento diario
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-red-600 mr-3"></i>
                            Suplementación profesional
                        </li>
                    </ul>
                    <a href="{{ route('contact') }}" class="block text-center bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                        Más Información
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CÓMO FUNCIONA -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-700 mb-12 uppercase">¿Cómo Funciona?</h2>
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center mb-12">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mb-4 md:mb-0 md:mr-8 flex-shrink-0">
                    1
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-2 text-red-700">Contáctanos</h3>
                    <p class="text-gray-600">Envíanos un mensaje a través de nuestro formulario de contacto o WhatsApp para evaluar tus objetivos.</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-center mb-12">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mb-4 md:mb-0 md:mr-8 flex-shrink-0">
                    2
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-2 text-red-700">Evaluación</h3>
                    <p class="text-gray-600">Realizamos una evaluación de tu condición física actual y definimos tus metas.</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-center mb-12">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mb-4 md:mb-0 md:mr-8 flex-shrink-0">
                    3
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-2 text-red-700">Plan Personalizado</h3>
                    <p class="text-gray-600">Creamos tu rutina personalizada y te enviamos los materiales necesarios para comenzar.</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-center">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold mb-4 md:mb-0 md:mr-8 flex-shrink-0">
                    4
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-2 text-red-700">Entrenamiento y Seguimiento</h3>
                    <p class="text-gray-600">Comienza tu entrenamiento con seguimiento constante y ajustes según tu progreso.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-gradient-to-r from-red-600 to-red-800 text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold mb-6 uppercase">¿Listo para comenzar tu transformación online?</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto text-white/90">
            No importa dónde estés, Pro Fitness está contigo. Contáctanos hoy.
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-red-600 px-10 py-3 rounded-lg font-semibold hover:bg-red-100 hover:scale-105 transition duration-300">
            Contáctanos
        </a>
    </div>
</section>
@endsection
