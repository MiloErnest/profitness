@extends('layouts.app')

@section('title', 'Máquinas Admin - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        <i class="fas fa-dumbbell text-red-600 mr-2"></i>Panel de Administración - Máquinas y Equipos
                    </h2>
                    <p class="text-gray-600 mt-2">Gestiona las máquinas y equipos del gimnasio</p>
                </div>
                <a href="{{ route('gym') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-300">
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
        </div>

        <!-- Botón Agregar -->
        <div class="mb-6">
            <a href="{{ route('machines.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-block">
                <i class="fas fa-plus mr-2"></i>Agregar Nueva Máquina
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
                        <i class="fas fa-dumbbell text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Total Máquinas</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $machines->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-green-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Máquinas Activas</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $machines->where('active', true)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-purple-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-tags text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Categorías</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $machines->pluck('category')->filter()->unique()->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="bg-red-500 text-white p-4 rounded-lg mr-4">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Máquinas Inactivas</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $machines->where('active', false)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Máquinas -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Imagen</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nombre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Categoría</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Marca</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Ubicación</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Descripción</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Estado</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($machines as $machine)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    @if($machine->image)
                                        <img src="{{ asset('storage/' . $machine->image) }}" 
                                             alt="{{ $machine->name }}"
                                             class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-dumbbell text-gray-400 text-xl"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-800">{{ $machine->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($machine->category)
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $machine->category }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-600 text-sm">
                                        {{ $machine->brand ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-600 text-sm">
                                        {{ $machine->location ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-600 text-sm">
                                        {{ Str::limit($machine->description ?? 'Sin descripción', 50) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($machine->active)
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Activo
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('machines.edit', $machine->id) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition duration-300"
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('machines.destroy', $machine->id) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar esta máquina?')">
                                            @csrf
                                            @method('DELETE')
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
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-dumbbell text-4xl mb-3 text-gray-300"></i>
                                    <p class="text-lg">No hay máquinas registradas</p>
                                    <a href="{{ route('machines.create') }}" class="text-red-600 hover:text-red-700 font-semibold mt-2 inline-block">
                                        Agregar la primera máquina
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
