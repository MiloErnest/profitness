@extends('layouts.app')

@section('title', 'Gimnasio - pro fitness')

@section('content')

<!-- HERO PRINCIPAL -->
<section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white py-28 overflow-hidden">
    <div class="container mx-auto px-6 relative z-10 text-center">
        <h1 class="text-6xl md:text-7xl font-extrabold mb-6 tracking-widest uppercase drop-shadow-lg">
            Gimnasio pro fitness
        </h1>
        <p class="text-lg md:text-xl mb-10 max-w-3xl mx-auto text-white/90 leading-relaxed">
            Donde la disciplina se convierte en fuerza y la pasión en resultados.  
            ¡Transforma tu cuerpo y tu mente con nosotros!
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('members.plans') }}" class="bg-white text-red-600 px-10 py-3 rounded-lg font-semibold hover:bg-red-100 transition duration-300">
                Inscríbete Hoy
            </a>
            <a href="#instalaciones" class="border-2 border-white text-white px-10 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition duration-300">
                Ver Instalaciones
            </a>
        </div>
    </div>
</section>

<!-- SECCIÓN DE INSTALACIONES -->
<section id="instalaciones" class="py-24 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-600 mb-12 uppercase">Nuestras Instalaciones</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Pesa -->
            <div class="bg-white border-2 border-red-100 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300">
                <img src="{{ asset('imagenes/AreaDePesas.jpg') }}" alt="Área de pesas" class="w-full h-56 object-cover rounded-t-xl">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-red-700 mb-2">Área de Pesas</h3>
                    <p class="text-gray-600">Equipos de fuerza profesionales, diseñados para llevar tu rendimiento al máximo nivel.</p>
                </div>
            </div>

            <!-- Cardio -->
            <div class="bg-white border-2 border-red-100 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300">
                <img src="{{ asset('imagenes/ZonaDeCardio.jpg') }}" alt="Zona de Cardio" class="w-full h-56 object-cover rounded-t-xl">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-red-700 mb-2">Zona de Cardio</h3>
                    <p class="text-gray-600">Caminadoras, bicicletas, elípticas y más para mejorar tu resistencia con la mejor tecnología.</p>
                </div>
            </div>

            <!-- Clases -->
            <div class="bg-white border-2 border-red-100 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300">
                <img src="{{ asset('imagenes/clases-grupales-phisique.jpg') }}" alt="Clases Grupales" class="w-full h-56 object-cover rounded-t-xl">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-red-700 mb-2">Clases Grupales</h3>
                    <p class="text-gray-600">Entrena en equipo, motívate y diviértete con nuestros programas dinámicos y variados.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ENTRENADORES -->
<section class="bg-red-50 py-24">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-600 mb-12 uppercase">Conoce a Nuestros Entrenadores</h2>

        @if($trainers->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Próximamente tendremos entrenadores disponibles</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
                @foreach($trainers as $trainer)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6">
                        @if($trainer->image)
                            <img src="{{ asset('storage/' . $trainer->image) }}" alt="{{ $trainer->name }}" class="w-32 h-32 mx-auto rounded-full object-cover mb-4 border-4 border-red-500">
                        @else
                            <div class="w-32 h-32 mx-auto rounded-full bg-gray-200 flex items-center justify-center mb-4 border-4 border-red-500">
                                <i class="fas fa-user text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        <h3 class="text-xl font-bold text-red-700 mb-1">{{ $trainer->name }}</h3>
                        <p class="text-red-600 font-semibold mb-2">{{ $trainer->specialty }}</p>
                        @if($trainer->experience)
                            <p class="text-red-500 text-xs mb-2">{{ $trainer->experience }}</p>
                        @endif
                        @if($trainer->description)
                            <p class="text-gray-600 text-sm">{{ $trainer->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- MÁQUINAS Y EQUIPOS -->
@if($machines->isNotEmpty())
<section class="py-24 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-red-600 mb-12 uppercase">Nuestro Equipamiento</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($machines as $machine)
                <div class="bg-white border-2 border-red-100 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300 overflow-hidden">
                    @if($machine->image)
                        <img src="{{ asset('storage/' . $machine->image) }}" alt="{{ $machine->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-dumbbell text-gray-400 text-5xl"></i>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-red-700 mb-1">{{ $machine->name }}</h3>
                        @if($machine->category)
                            <p class="text-red-600 text-sm font-semibold mb-2">{{ $machine->category }}</p>
                        @endif
                        @if($machine->brand)
                            <p class="text-gray-500 text-xs mb-2">Marca: {{ $machine->brand }}</p>
                        @endif
                        @if($machine->location)
                            <p class="text-gray-500 text-xs mb-2">Ubicación: {{ $machine->location }}</p>
                        @endif
                        @if($machine->description)
                            <p class="text-gray-600 text-sm">{{ Str::limit($machine->description, 80) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA FINAL -->
<section class="py-24 bg-gradient-to-r from-red-600 via-red-700 to-red-800 text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4 uppercase">¡Empieza hoy tu transformación!</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto text-white/90">
            En pro fitness no solo entrenas, evolucionas.  
            Tu mejor versión te está esperando.
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-red-700 px-10 py-3 rounded-lg font-bold hover:bg-red-100 transition duration-300">
            Contáctanos
        </a>
    </div>
</section>

@endsection
