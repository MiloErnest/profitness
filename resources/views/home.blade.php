@extends('layouts.app')

@section('title', 'pro fitness - Transforma tu Cuerpo, Transforma tu Vida')

@section('content')

<!-- HERO PRINCIPAL -->
<section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white py-32 overflow-hidden">
    <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-6xl font-extrabold mb-6 uppercase tracking-widest drop-shadow-lg">
            pro fitness
        </h1>
        <p class="text-xl mb-10 max-w-2xl mx-auto text-white/90 leading-relaxed">
            La constancia supera al talento. Entrena con nosotros y siente la fuerza del cambio.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('members.plans') }}" class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-red-100 hover:scale-105 transition duration-300">
                Inscríbete Ya
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-600 hover:scale-105 transition duration-300">
                Contáctanos
            </a>
        </div>
    </div>
</section>

<!-- SERVICIOS -->
<section class="py-24 bg-gradient-to-b from-white via-red-50 to-red-100">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-700 mb-4 uppercase">Nuestros Servicios</h2>
        <p class="text-center text-red-800 mb-12 max-w-2xl mx-auto">
            Entrena con pasión, energía y dedicación. Nuestros espacios y entrenadores están listos para ti.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Clases Grupales -->
            <div class="bg-gradient-to-b from-white to-red-50 border border-red-200 rounded-xl p-8 text-center hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg">
                    <i class="fas fa-users text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-red-700">Clases Grupales</h3>
                <p class="text-red-800">Siente la motivación y energía de entrenar acompañado. ¡El impulso que necesitas!</p>
            </div>

            <!-- Pesas -->
            <div class="bg-gradient-to-b from-white to-red-50 border border-red-200 rounded-xl p-8 text-center hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                <div class="bg-gradient-to-br from-red-500 to-red-700 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg">
                    <i class="fas fa-dumbbell text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-red-700">Área de Pesas</h3>
                <p class="text-red-800">Potencia tu fuerza con equipos modernos y un ambiente diseñado para tu progreso.</p>
            </div>

            <!-- Cardio -->
            <div class="bg-gradient-to-b from-white to-red-50 border border-red-200 rounded-xl p-8 text-center hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg">
                    <i class="fas fa-heartbeat text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-red-700">Zona de Cardio</h3>
                <p class="text-red-800">Activa tu cuerpo y mejora tu resistencia en un espacio diseñado para desafiarte.</p>
            </div>
        </div>
    </div>
</section>

<!-- FRASE MOTIVACIONAL -->
<section class="py-24 bg-gradient-to-r from-red-400 via-red-500 to-red-700 text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 uppercase">“Haz que cada entrenamiento cuente.”</h2>
        <p class="text-lg mb-8 max-w-3xl mx-auto text-white/90">
            En pro fitness, cada gota de esfuerzo suma. No se trata solo de entrenar, sino de construir una versión más fuerte de ti.
        </p>
        <a href="{{ route('members.plans') }}" class="bg-white text-red-600 px-10 py-3 rounded-lg font-semibold hover:bg-red-100 hover:scale-105 transition duration-300">
            Únete Hoy
        </a>
    </div>
</section>

<!-- CTA FINAL -->
<section class="py-24 bg-gradient-to-b from-red-50 via-white to-red-100 text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold mb-6 text-red-700 uppercase">¿Listo para Empezar?</h2>
        <p class="text-lg mb-8 text-red-800 max-w-2xl mx-auto">
            La mejor inversión es en ti mismo. Da el primer paso hacia una vida más fuerte, sana y motivada.
        </p>
        <a href="{{ route('members.plans') }}" class="bg-gradient-to-r from-red-600 to-red-700 text-white px-10 py-3 rounded-lg font-semibold hover:from-red-700 hover:to-red-800 hover:scale-105 transition duration-300">
            Ver Planes
        </a>
    </div>
</section>

@endsection
