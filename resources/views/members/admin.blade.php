@extends('layouts.app')

@section('title', 'Miembros - Panel Admin - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-id-card-alt text-red-600 mr-2"></i>Gestión de Miembros
                </h2>
                <p class="text-gray-600 mt-2">Registra y controla las membresías activas del gimnasio</p>
            </div>
            <a href="{{ route('home') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Ir al inicio
            </a>
        </div>

        <div class="flex gap-4 mb-6">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-300 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Dashboard
            </a>
            <a href="{{ route('members.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-block">
                <i class="fas fa-user-plus mr-2"></i>Registrar nuevo miembro
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="bg-red-500 text-white p-4 rounded-lg mr-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Total Miembros</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $members->count() }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="bg-green-500 text-white p-4 rounded-lg mr-4">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Membresías Activas</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $members->filter->is_active->count() }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="bg-gray-500 text-white p-4 rounded-lg mr-4">
                    <i class="fas fa-user-clock text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Membresías Vencidas</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $members->reject->is_active->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nombre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Plan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Inicio</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Fin</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Días restantes</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Estado</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Contacto</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($members as $member)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $member->name }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $member->membershipPlan->name ?? 'N/A' }}
                                    @if($member->membershipPlan)
                                        <span class="block text-xs text-gray-500">
                                            {{ $member->membershipPlan->duration_days }} días - ${{ number_format($member->membershipPlan->price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $member->start_date?->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $member->end_date?->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    @php($remaining = $member->remaining_days)
                                    @if($remaining === null)
                                        <span class="text-gray-400">-</span>
                                    @elseif($remaining < 0)
                                        <span class="text-red-600 font-semibold">Vencida hace {{ abs($remaining) }} días</span>
                                    @else
                                        <span class="text-green-600 font-semibold">{{ $remaining }} días</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($member->is_active)
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Activa</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Vencida</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @if($member->email)
                                        <div class="flex items-center text-gray-700">
                                            <i class="fas fa-envelope mr-2 text-red-500"></i>{{ $member->email }}
                                        </div>
                                    @endif
                                    @if($member->phone)
                                        <div class="flex items-center text-gray-700 mt-1">
                                            <i class="fas fa-phone mr-2 text-red-500"></i>{{ $member->phone }}
                                        </div>
                                    @endif
                                    @if(!$member->email && !$member->phone)
                                        <span class="text-gray-400">Sin datos de contacto</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('members.edit', $member->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition duration-300" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este miembro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition duration-300" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-id-card-alt text-4xl mb-3 text-gray-300"></i>
                                    <p class="text-lg">No hay miembros registrados todavía</p>
                                    <a href="{{ route('members.create') }}" class="text-red-600 hover:text-red-700 font-semibold mt-2 inline-block">
                                        Registrar el primer miembro
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
