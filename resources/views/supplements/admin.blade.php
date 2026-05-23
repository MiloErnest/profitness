@extends('layouts.app')

@section('title', 'Suplementos Admin - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        <i class="fas fa-capsules text-red-600 mr-2"></i>Panel de Administración - Suplementos
                    </h2>
                    <p class="text-gray-600 mt-2">Gestiona el inventario de suplementos</p>
                </div>
                <a href="{{ route('supplements') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Ver como cliente
                </a>
            </div>
        </div>

        <!-- Navegación -->
        <div class="flex gap-4 mb-6">
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-300 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Dashboard
            </a>
            <a href="{{ route('supplements.report') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-300 inline-block">
                <i class="fas fa-chart-bar mr-2"></i>Ver Reporte Detallado
            </a>
        </div>

        <!-- Botón Agregar -->
        <div class="mb-6">
            <a href="{{ route('supplements.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-block">
                <i class="fas fa-plus mr-2"></i>Agregar Nuevo Suplemento
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Estadísticas Superiores -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-blue-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-box text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Total Productos</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $supplements->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-green-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-boxes text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Stock Total</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $supplements->sum('stock') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-purple-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-dollar-sign text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Valor Inventario</p>
                        <p class="text-2xl font-bold text-purple-600">
                            ${{ number_format($supplements->sum('total_value'), 0, ',', '.') }}
                        </p>
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
                        <p class="text-2xl font-bold text-gray-800">{{ $supplements->where('stock', '<', 5)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Suplementos -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Imagen</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nombre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Categoría</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Precio Unit.</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Recibido</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Vendido</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Stock</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Valor Total</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($supplements as $supplement)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    @if($supplement->image)
                                        <img src="{{ asset('storage/' . $supplement->image) }}" 
                                             alt="{{ $supplement->name }}"
                                             class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-capsules text-gray-400 text-xl"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-800">{{ $supplement->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $supplement->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-green-600 font-bold">
                                        ${{ number_format($supplement->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-blue-600">{{ $supplement->received }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-red-600">{{ $supplement->sold }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span class="font-bold {{ $supplement->stock < 5 ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $supplement->stock }}
                                        </span>
                                        @if($supplement->stock < 5)
                                            <i class="fas fa-exclamation-circle text-red-500 ml-2" title="Stock bajo"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-purple-600 font-bold">
                                        ${{ number_format($supplement->total_value, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('supplements.edit', $supplement->id) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition duration-300"
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('supplements.destroy.post', $supplement->id) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este suplemento?')">
                                            @csrf
                                            <button type="submit" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition duration-300"
                                                    title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-capsules text-4xl mb-3 text-gray-300"></i>
                                    <p class="text-lg">No hay suplementos registrados</p>
                                    <a href="{{ route('supplements.create') }}" class="text-red-600 hover:text-red-700 font-semibold mt-2 inline-block">
                                        Agregar el primer suplemento
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($supplements->count() > 0)
                        <tfoot class="bg-gray-50 font-bold">
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-right text-gray-800">TOTALES:</td>
                                <td class="px-6 py-4 text-blue-600">{{ $supplements->sum('received') }}</td>
                                <td class="px-6 py-4 text-red-600">{{ $supplements->sum('sold') }}</td>
                                <td class="px-6 py-4 text-green-600">{{ $supplements->sum('stock') }}</td>
                                <td class="px-6 py-4 text-purple-600">
                                    ${{ number_format($supplements->sum('total_value'), 0, ',', '.') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection