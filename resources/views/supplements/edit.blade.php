@extends('layouts.app')

@section('title', 'Editar Suplemento - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-3xl">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-edit text-yellow-600 mr-2"></i>Editar Suplemento
            </h2>
            <p class="text-gray-600 mt-2">Modifica la información del suplemento</p>
        </div>

        <!-- Botón Volver -->
        <div class="mb-6">
            <a href="{{ route('supplements.admin') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-300 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Suplementos
            </a>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('supplements.update', $supplement->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-tag mr-1 text-red-600"></i>Nombre del suplemento *
                    </label>
                    <input type="text" 
                           name="name" 
                           value="{{ $supplement->name }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                           required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-list mr-1 text-red-600"></i>Categoría *
                    </label>
                    <select name="category" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            required>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ $supplement->category == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-dollar-sign mr-1 text-blue-600"></i>Precio de Compra *
                        </label>
                        <input type="number" 
                               step="0.01" 
                               name="cost_price" 
                               value="{{ $supplement->cost_price ?? 0 }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Precio al que lo compraste</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-dollar-sign mr-1 text-red-600"></i>Precio de Venta *
                        </label>
                        <input type="number" 
                               step="0.01" 
                               name="price" 
                               value="{{ $supplement->price }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Precio de venta al público</p>
                    </div>
                </div>

                <!-- Sección de Control de Inventario -->
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mb-6">
                    <h3 class="font-bold text-gray-800 mb-3">
                        <i class="fas fa-warehouse text-blue-600 mr-2"></i>Control de Inventario
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-box-open mr-1 text-blue-600"></i>Recibido *
                            </label>
                            <input type="number" 
                                   name="received" 
                                   value="{{ $supplement->received }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   min="0"
                                   required>
                            <p class="text-xs text-gray-500 mt-1">Unidades compradas o ingresadas</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-plus-circle mr-1 text-green-600"></i>Adicional
                            </label>
                            <input type="number" 
                                   name="additional_stock" 
                                   value="{{ $supplement->additional_stock ?? 0 }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                   min="0">
                            <p class="text-xs text-gray-500 mt-1">Donaciones, devoluciones, ajustes</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-shopping-cart mr-1 text-red-600"></i>Vendido *
                            </label>
                            <input type="number" 
                                   name="sold" 
                                   value="{{ $supplement->sold }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                   min="0"
                                   required>
                            <p class="text-xs text-gray-500 mt-1">Unidades vendidas</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-exclamation-triangle mr-1 text-orange-600"></i>Pérdidas
                            </label>
                            <input type="number" 
                                   name="lost_stock" 
                                   value="{{ $supplement->lost_stock ?? 0 }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                   min="0">
                            <p class="text-xs text-gray-500 mt-1">Vencidos, muestras, robos, daños</p>
                        </div>
                    </div>
                </div>

                <!-- Información calculada -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 border-l-4 border-blue-500 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-calculator text-blue-600 mr-2"></i>
                        Información Calculada Automáticamente
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-lg p-3 shadow-sm">
                            <span class="text-gray-600 text-sm">Stock disponible:</span>
                            <p class="font-bold text-lg text-blue-600">{{ $supplement->stock }} unidades</p>
                        </div>
                        <div class="bg-white rounded-lg p-3 shadow-sm">
                            <span class="text-gray-600 text-sm">Valor total inventario:</span>
                            <p class="font-bold text-lg text-purple-600">${{ number_format($supplement->total_value, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-align-left mr-1 text-red-600"></i>Descripción
                    </label>
                    <textarea name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">{{ $supplement->description }}</textarea>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-image mr-1 text-red-600"></i>Imagen del suplemento
                    </label>
                    
                    @if($supplement->image)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Imagen actual:</p>
                            <img src="{{ asset('storage/' . $supplement->image) }}" 
                                 alt="{{ $supplement->name }}"
                                 class="w-48 h-48 object-cover rounded-lg shadow-md">
                        </div>
                    @endif

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-red-500 transition-colors">
                        <input type="file" 
                               name="image" 
                               accept="image/*"
                               class="w-full">
                        <p class="text-gray-500 text-sm mt-2">
                            {{ $supplement->image ? 'Selecciona una nueva imagen para reemplazar la actual' : 'Agrega una imagen' }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                        <i class="fas fa-save mr-2"></i>Actualizar Suplemento
                    </button>
                    <a href="{{ route('supplements.admin') }}" 
                       class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection