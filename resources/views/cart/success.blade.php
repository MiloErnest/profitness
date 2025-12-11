@extends('layouts.app')

@section('title', 'Pedido completado - Pro.Fitness')

@section('content')
<section class="min-h-screen bg-gradient-to-br from-white via-red-50 to-red-100 flex items-center">
    <div class="container mx-auto px-6">
        <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-md p-8 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-red-700 mb-2">¡Pedido realizado con éxito!</h1>
            <p class="text-gray-600 mb-4">Hemos registrado tu pedido con el número:</p>
            <p class="text-3xl font-extrabold text-red-700 mb-4">#{{ $order->id }}</p>
            <p class="text-gray-500 mb-6">Pronto nos pondremos en contacto al correo <span class="font-semibold">{{ $order->customer_email }}</span> para coordinar los detalles de pago y/o entrega.</p>
            <a href="{{ url('/') }}" class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                Volver al inicio
            </a>
        </div>
    </div>
</section>
@endsection
