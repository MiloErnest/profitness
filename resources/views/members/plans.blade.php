@extends('layouts.app')

@section('title', 'Planes de Membresía - Pro.Fitness')

@section('content')
<section class="relative bg-gradient-to-br from-white via-red-100 to-red-600 text-red-900 py-24 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-red-500 via-red-600 to-red-700 opacity-80 mix-blend-multiply"></div>
    <div class="container mx-auto px-6 relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 uppercase tracking-widest drop-shadow-lg">Planes de Membresía</h1>
        <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto text-white/90">
            Elige el plan que mejor se adapte a tu ritmo. Entrena por un día, una semana, una quincena, un mes o en pareja.
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-red-100 hover:scale-105 transition duration-300">
            ¿Tienes dudas? Contáctanos
        </a>
    </div>
</section>

<section class="py-24 bg-gradient-to-b from-red-50 via-white to-red-100">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($plans as $plan)
                <div class="bg-white rounded-2xl shadow-md border border-red-100 flex flex-col items-center text-center p-6 hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <h2 class="text-xl font-extrabold text-red-700 mb-2 uppercase">{{ $plan->name }}</h2>
                    <p class="text-sm text-red-500 mb-4">{{ $plan->duration_days }} días</p>
                    <p class="text-3xl font-extrabold text-red-700 mb-4">
                        ${{ number_format($plan->price, 0, ',', '.') }}
                    </p>
                    <ul class="text-sm text-gray-600 mb-6 space-y-1">
                        <li>Acceso total al gimnasio</li>
                        <li>Ambiente motivador</li>
                        <li>Entrenadores disponibles en sala</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="mt-auto inline-block bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                        Inscríbete ya
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
