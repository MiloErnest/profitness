@extends('layouts.app')

@section('title', 'Registrar Miembro - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-user-plus text-red-600 mr-2"></i>Registrar nuevo miembro
            </h2>
            <a href="{{ route('members.admin') }}" class="text-sm text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-1"></i>Volver
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('members.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico (opcional)</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono (opcional)</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        @error('phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="membership_plan_id" class="block text-sm font-medium text-gray-700 mb-1">Plan de membresía</label>
                    <select id="membership_plan_id" name="membership_plan_id" class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" required>
                        <option value="">Selecciona un plan</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" @selected(old('membership_plan_id') == $plan->id)>
                                {{ $plan->name }} - {{ $plan->duration_days }} días - ${{ number_format($plan->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('membership_plan_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>

   
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de inicio</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" required>
                    @error('start_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                        <i class="fas fa-save mr-2"></i>Guardar miembro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
