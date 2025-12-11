@extends('layouts.app')

@section('title', 'Checkout - Pro.Fitness')

@section('content')
<section class="min-h-screen bg-gradient-to-br from-white via-red-50 to-red-100 py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl md:text-4xl font-extrabold text-red-700 mb-8 text-center uppercase tracking-widest">
            Checkout
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-bold text-red-700 mb-4">Datos del cliente</h2>

                <form action="{{ route('cart.processCheckout') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required class="w-full px-3 py-2 border border-red-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        @error('customer_name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}" required class="w-full px-3 py-2 border border-red-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        @error('customer_email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" class="w-full px-3 py-2 border border-red-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        @error('customer_phone')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{ route('cart.index') }}" class="text-red-600 hover:text-red-800 font-semibold">
                            Volver al carrito
                        </a>
                        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                            Confirmar pedido (simulado)
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-bold text-red-700 mb-4">Resumen del pedido</h2>
                <div class="space-y-3 max-h-64 overflow-y-auto pr-2">
                    @foreach($cart as $item)
                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-500">x {{ $item['qty'] }}</p>
                            </div>
                            <p class="font-bold text-red-700">
                                ${{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="h-px bg-red-100 my-4"></div>
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
            </div>
        </div>
    </div>
</section>
@endsection
