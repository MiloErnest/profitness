@extends('layouts.app')

@section('title', 'Quiénes Somos - Pro Fitness')

@section('content')
<!-- HERO SECTION -->
<section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white py-24">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-extrabold mb-6 uppercase tracking-widest">Quiénes Somos</h1>
        <p class="text-xl max-w-2xl mx-auto text-white/90">
            Más que un gimnasio, somos una comunidad comprometida con tu transformación.
        </p>
    </div>
</section>

<!-- NUESTRA HISTORIA -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-extrabold text-center text-red-700 mb-8 uppercase">Nuestra Historia</h2>
            <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                Pro Fitness nació con la visión de transformar vidas a través del fitness. Desde nuestros inicios, 
                nos hemos comprometido a crear un espacio donde cada persona pueda alcanzar sus metas de salud y bienestar,
                sin importar su nivel de experiencia.
            </p>
            <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                A lo largo de los años, hemos crecido gracias a la confianza de nuestra comunidad. 
                Hoy somos un referente en Ocaña, ofreciendo instalaciones de primer nivel, 
                entrenadores certificados y programas personalizados que se adaptan a tus necesidades.
            </p>
        </div>
    </div>
</section>

<!-- NUESTRA MISIÓN -->
<section class="py-20 bg-gradient-to-b from-red-50 to-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-700 mb-12 uppercase">Nuestra Misión</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-red-700">Salud Integral</h3>
                <p class="text-gray-600">
                    Promovemos no solo el fitness físico, sino también el bienestar mental y emocional de cada miembro.
                </p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-red-700">Comunidad</h3>
                <p class="text-gray-600">
                    Construimos una comunidad de apoyo donde cada persona se siente motivada y acompañada en su proceso.
                </p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                <div class="bg-gradient-to-br from-red-400 to-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-red-700">Excelencia</h3>
                <p class="text-gray-600">
                    Nos esforzamos por ofrecer la mejor experiencia con equipos de calidad y entrenadores certificados.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- NUESTROS VALORES -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-700 mb-12 uppercase">Nuestros Valores</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="flex items-start space-x-4">
                <div class="bg-red-600 text-white p-3 rounded-lg">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2 text-red-700">Compromiso</h3>
                    <p class="text-gray-600">Nos comprometemos con tus objetivos y te acompañamos en cada paso.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-red-600 text-white p-3 rounded-lg">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2 text-red-700">Pasión</h3>
                    <p class="text-gray-600">Amamos lo que hacemos y transmitimos esa energía en cada sesión.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-red-600 text-white p-3 rounded-lg">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2 text-red-700">Respeto</h3>
                    <p class="text-gray-600">Valoramos a cada persona y creamos un ambiente inclusivo y respetuoso.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-red-600 text-white p-3 rounded-lg">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2 text-red-700">Innovación</h3>
                    <p class="text-gray-600">Nos mantenemos actualizados con las últimas tendencias del fitness.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-gradient-to-r from-red-600 to-red-800 text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold mb-6 uppercase">¿Listo para ser parte de nuestra familia?</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto text-white/90">
            Únete a Pro Fitness y comienza tu transformación hoy mismo.
        </p>
        <a href="{{ route('members.plans') }}" class="bg-white text-red-600 px-10 py-3 rounded-lg font-semibold hover:bg-red-100 hover:scale-105 transition duration-300">
            Ver Planes
        </a>
    </div>
</section>
@endsection
