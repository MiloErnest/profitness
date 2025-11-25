@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Header del Panel -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        <i class="fas fa-cog text-red-600 mr-2"></i>Panel de Administración - Cafetería
                    </h2>
                    <p class="text-gray-600 mt-2">Gestiona los productos de la cafetería</p>
                </div>
                <a href="{{ route('cafeteria.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Ver como cliente
                </a>
            </div>
        </div>

  <div class="mb-6">
    <a href="{{ route('admin.dashboard') }}" 
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-300 inline-block">
        <i class="fas fa-arrow-left mr-2"></i>Dashboard
    </a>
</div>

        <!-- Botones de Acción -->
        <div class="mb-6 flex gap-3">
            <a href="{{ route('cafeteria.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-block">
                <i class="fas fa-plus mr-2"></i>Agregar nuevo producto
            </a>
            <a href="{{ route('cafeteria.report') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-block">
                <i class="fas fa-chart-bar mr-2"></i>Ver Reporte Detallado
            </a>
        </div>

        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Tabla de Productos -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Imagen</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nombre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Categoría</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Precio</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Stock</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Descripción</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($products as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" 
                                             alt="{{ $item->product_name }}"
                                             class="w-20 h-20 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-800">{{ $item->product_name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $item->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-green-600 font-bold text-lg">
                                        ${{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->stock > 10)
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $item->stock }} unidades
                                        </span>
                                    @elseif($item->stock > 0)
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $item->stock }} unidades
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Agotado
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-600 text-sm">
                                        {{ Str::limit($item->description, 50) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('cafeteria.edit', $item->id) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition duration-300">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('cafeteria.destroy', $item->id) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-300">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                    <p class="text-lg">No hay productos registrados</p>
                                    <a href="{{ route('cafeteria.create') }}" class="text-red-600 hover:text-red-700 font-semibold mt-2 inline-block">
                                        Agregar el primer producto
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-blue-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-box text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Total Productos</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $products->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-green-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Productos Disponibles</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $products->where('stock', '>', 0)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-red-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Stock Bajo (< 5)</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $products->where('stock', '<', 5)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection