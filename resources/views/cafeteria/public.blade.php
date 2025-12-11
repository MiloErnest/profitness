@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-red-600 to-red-800 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <i class="fas fa-coffee mr-3"></i>Cafetería ProFitness
        </h1>
        <p class="text-xl text-red-100">Bebidas energéticas y saludables para complementar tu entrenamiento</p>
    </div>
</div>

<!-- Productos Section -->
<div class="container mx-auto px-4 py-12">
    @if($products->isEmpty())
        <div class="text-center py-16">
            <i class="fas fa-coffee text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500 text-xl">No hay productos disponibles en este momento</p>
        </div>
    @else
        <!-- Grid de productos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $item)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Imagen del producto -->
                    <div class="relative h-64 bg-gray-100">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 alt="{{ $item->product_name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full">
                                <i class="fas fa-glass-whiskey text-gray-300 text-6xl"></i>
                            </div>
                        @endif
                        
                        <!-- Badge de categoría -->
                        <div class="absolute top-3 right-3">
                            <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $item->category }}
                            </span>
                        </div>

                        <!-- Badge de stock bajo -->
                        @if($item->stock < 5)
                            <div class="absolute top-3 left-3">
                                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Pocas unidades
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Información del producto -->
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->product_name }}</h3>
                        
                        @if($item->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $item->description }}</p>
                        @endif

                        <!-- Precio, disponibilidad y carrito -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-3xl font-bold text-red-600">
                                        ${{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="text-right">
                                    @if($item->stock > 0)
                                        <span class="text-green-600 font-semibold flex items-center">
                                            <i class="fas fa-check-circle mr-1"></i>Disponible
                                        </span>
                                        <span class="text-gray-500 text-sm">Stock: {{ $item->stock }}</span>
                                    @else
                                        <span class="text-red-600 font-semibold">
                                            <i class="fas fa-times-circle mr-1"></i>Agotado
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($item->stock > 0)
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="cafeteria">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                                        Agregar al carrito
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Sección de información adicional -->
<div class="bg-gray-50 py-12 mt-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6">
                <div class="bg-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-leaf text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Productos Naturales</h3>
                <p class="text-gray-600">Bebidas preparadas con ingredientes naturales y saludables</p>
            </div>

            <div class="p-6">
                <div class="bg-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bolt text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Energía Instantánea</h3>
                <p class="text-gray-600">Perfectas para antes o después de tu entrenamiento</p>
            </div>

            <div class="p-6">
                <div class="bg-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Preparación Rápida</h3>
                <p class="text-gray-600">Ordena y recibe tu bebida en minutos</p>
            </div>
        </div>
    </div>
</div>
@endsection