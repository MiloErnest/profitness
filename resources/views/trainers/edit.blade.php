@extends('layouts.app')

@section('title', 'Editar Entrenador - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-3xl">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-edit text-red-600 mr-2"></i>Editar Entrenador
            </h2>
            <p class="text-gray-600 mt-2">Actualiza la información del entrenador</p>
        </div>

        <!-- Botón Volver -->
        <div class="mb-6">
            <a href="{{ route('trainers.admin') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-300 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Entrenadores
            </a>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('trainers.update', $trainer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-user mr-1 text-red-600"></i>Nombre Completo *
                    </label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $trainer->name) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                           required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-certificate mr-1 text-red-600"></i>Especialidad *
                    </label>
                    <input type="text" 
                           name="specialty" 
                           value="{{ old('specialty', $trainer->specialty) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                           required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-clock mr-1 text-red-600"></i>Experiencia
                    </label>
                    <input type="text" 
                           name="experience" 
                           value="{{ old('experience', $trainer->experience) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-align-left mr-1 text-red-600"></i>Descripción
                    </label>
                    <textarea name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('description', $trainer->description) }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-image mr-1 text-red-600"></i>Imagen Actual
                    </label>
                    @if($trainer->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $trainer->image) }}" alt="{{ $trainer->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-red-500">
                        </div>
                    @endif
                    <input type="file" 
                           name="image" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    <p class="text-sm text-gray-500 mt-1">Deja en blanco para mantener la imagen actual. Formatos: JPG, PNG, GIF. Tamaño máximo: 2MB</p>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="active" 
                               value="1"
                               {{ old('active', $trainer->active) ? 'checked' : '' }}
                               class="mr-2 w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <span class="text-gray-700 font-semibold">Activo (visible en el sitio web)</span>
                    </label>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                        <i class="fas fa-save mr-2"></i>Actualizar Entrenador
                    </button>
                    <a href="{{ route('trainers.admin') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

