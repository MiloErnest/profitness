@extends('layouts.app')

@section('title', 'Carrito de Compras - Pro.Fitness')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-white via-red-50 to-red-100 py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl md:text-4xl font-extrabold text-red-700 mb-8 text-center uppercase tracking-widest">
            Carrito de Compras
        </h1>

        @if(empty($cart))
            <div class="bg-white rounded-2xl shadow-md p-8 text-center">
                <p class="text-gray-600 mb-4">Tu carrito está vacío.</p>
                <a href="{{ route('members.plans') }}" class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    Ver planes de membresía
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-red-700 mb-4">Detalle de productos</h2>
                    <div class="divide-y divide-red-100">
                        @foreach($cart as $item)
                            <div class="py-4 flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                    <p class="text-sm text-gray-500 capitalize">Tipo: {{ str_replace('_', ' ', $item['type']) }}</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        <input type="hidden" name="key" value="{{ $item['key'] }}">
                                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="w-16 border border-red-200 rounded-lg px-2 py-1 text-center">
                                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-semibold">Actualizar</button>
                                    </form>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="key" value="{{ $item['key'] }}">
                                        <button type="submit" class="text-sm text-gray-400 hover:text-red-600">
                                            Eliminar
                                        </button>
                                    </form>
                                    <div class="text-right">
                                        <p class="font-bold text-red-700">
                                            ${{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            ${{ number_format($item['price'], 0, ',', '.') }} c/u
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-red-700 mb-4">Resumen</h2>
                    <div class="space-y-2 text-sm text-gray-700">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Impuestos</span>
                            <span>${{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="h-px bg-red-100 my-2"></div>
                        <div class="flex justify-between font-bold text-red-700 text-lg">
                            <span>Total</span>
                            <span>${{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <a href="{{ route('cart.checkout') }}" class="block w-full text-center bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                            Ir al Checkout
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('¿Vaciar carrito?');">
                            @csrf
                            <button type="submit" class="w-full text-center border border-red-200 text-red-600 py-2 rounded-lg font-semibold hover:bg-red-50 transition">
                                Vaciar carrito
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
