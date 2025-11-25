@extends('layouts.app')

@section('title', 'Agregar Ropa Deportiva - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-3xl">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-plus-circle text-red-600 mr-2"></i>Agregar Nuevo Producto
            </h2>
            <p class="text-gray-600 mt-2">Completa la información del producto</p>
        </div>

        <!-- Botón Volver -->
        <div class="mb-6">
            <a href="{{ route('sport_clothes.admin') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-300 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Ropa Deportiva
            </a>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('sport_clothes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-tag mr-1 text-red-600"></i>Nombre del producto *
                    </label>
                    <input type="text" 
                           name="product_name" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                           placeholder="Ej: Zapatillas ProRun, Top Deportivo Fit"
                           required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-venus-mars mr-1 text-red-600"></i>Género *
                        </label>
                        <select name="gender" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                required>
                            <option value="">Seleccionar género</option>
                            @foreach($genders as $gender)
                                <option value="{{ $gender }}">{{ ucfirst($gender) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-list mr-1 text-red-600"></i>Categoría *
                        </label>
                        <select name="category" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                required>
                            <option value="">Seleccionar categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-dollar-sign mr-1 text-blue-600"></i>Precio de Compra *
                        </label>
                        <input type="number" 
                               step="0.01" 
                               name="cost_price" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="0.00"
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
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                               placeholder="0.00"
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
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0"
                                   min="0"
                                   value="0"
                                   required>
                            <p class="text-xs text-gray-500 mt-1">Unidades compradas o ingresadas</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-plus-circle mr-1 text-green-600"></i>Adicional
                            </label>
                            <input type="number" 
                                   name="additional_stock" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                   placeholder="0"
                                   min="0"
                                   value="0">
                            <p class="text-xs text-gray-500 mt-1">Donaciones, devoluciones, ajustes</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-shopping-cart mr-1 text-red-600"></i>Vendido *
                            </label>
                            <input type="number" 
                                   name="sold" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                   placeholder="0"
                                   min="0"
                                   value="0"
                                   required>
                            <p class="text-xs text-gray-500 mt-1">Unidades vendidas</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-exclamation-triangle mr-1 text-orange-600"></i>Pérdidas
                            </label>
                            <input type="number" 
                                   name="lost_stock" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                   placeholder="0"
                                   min="0"
                                   value="0">
                            <p class="text-xs text-gray-500 mt-1">Robos, daños, muestras gratis</p>
                        </div>
                    </div>
                </div>

                <!-- Info Box de Stock Calculado -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        <p class="text-sm text-blue-800">
                            <span class="font-semibold">Stock disponible</span> se calcula automáticamente: (Recibido + Adicional) - (Vendido + Pérdidas)
                        </p>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-align-left mr-1 text-red-600"></i>Descripción
                    </label>
                    <textarea name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                              placeholder="Describe el producto, características, beneficios..."></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-sticky-note mr-1 text-red-600"></i>Notas
                    </label>
                    <textarea name="notes" 
                              rows="2"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                              placeholder="Notas u observaciones del producto"></textarea>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-image mr-1 text-red-600"></i>Imagen del producto
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-red-500 transition-colors">
                        <input type="file" 
                               name="image" 
                               accept="image/*"
                               class="w-full"
                               id="imageInput">
                        <p class="text-gray-500 text-sm mt-2">Formatos: JPG, PNG. Tamaño máximo: 2MB</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                        <i class="fas fa-save mr-2"></i>Guardar Producto
                    </button>
                    <a href="{{ route('sport_clothes.admin') }}" 
                       class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

