@extends('layouts.app')

@section('title', 'Agregar Máquina - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-3xl">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-plus-circle text-red-600 mr-2"></i>Agregar Nueva Máquina
            </h2>
            <p class="text-gray-600 mt-2">Completa la información del equipo</p>
        </div>

        <!-- Botón Volver -->
        <div class="mb-6">
            <a href="{{ route('machines.admin') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-300 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Máquinas
            </a>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('machines.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-dumbbell mr-1 text-red-600"></i>Nombre de la Máquina *
                    </label>
                    <input type="text" 
                           name="name" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                           placeholder="Ej: Prensa de Piernas, Caminadora Pro, Banco de Pesas"
                           required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-list mr-1 text-red-600"></i>Categoría
                        </label>
                        <input type="text" 
                               name="category" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                               placeholder="Ej: Pesas, Cardio, Funcional">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-tag mr-1 text-red-600"></i>Marca
                        </label>
                        <input type="text" 
                               name="brand" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                               placeholder="Ej: Technogym, Life Fitness">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map-marker-alt mr-1 text-red-600"></i>Ubicación
                    </label>
                    <input type="text" 
                           name="location" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                           placeholder="Ej: Zona de Pesas, Área de Cardio, Piso 2">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-align-left mr-1 text-red-600"></i>Descripción
                    </label>
                    <textarea name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                              placeholder="Descripción del equipo, características, especificaciones técnicas, etc."></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-image mr-1 text-red-600"></i>Imagen
                    </label>
                    <input type="file" 
                           name="image" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    <p class="text-sm text-gray-500 mt-1">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</p>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="active" 
                               value="1"
                               checked
                               class="mr-2 w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <span class="text-gray-700 font-semibold">Activo (visible en el sitio web)</span>
                    </label>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                        <i class="fas fa-save mr-2"></i>Guardar Máquina
                    </button>
                    <a href="{{ route('machines.admin') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

