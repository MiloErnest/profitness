@extends('layouts.app')

@section('title', 'Panel de Administración - pro fitness')

@section('content')
<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .animate-fadeInDown {
        animation: fadeInDown 0.6s ease-out forwards;
    }

    .animate-slideInLeft {
        animation: slideInLeft 0.6s ease-out forwards;
    }

    .animate-zoomIn {
        animation: zoomIn 0.5s ease-out forwards;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .delay-100 {
        animation-delay: 0.1s;
        opacity: 0;
    }

    .delay-200 {
        animation-delay: 0.2s;
        opacity: 0;
    }

    .delay-300 {
        animation-delay: 0.3s;
        opacity: 0;
    }

    .delay-400 {
        animation-delay: 0.4s;
        opacity: 0;
    }

    .delay-500 {
        animation-delay: 0.5s;
        opacity: 0;
    }

    .admin-card {
        transition: all 0.3s ease;
    }

    .admin-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-600 to-red-800 shadow-2xl animate-fadeInDown">
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 p-4 rounded-full animate-float">
                        <i class="fas fa-shield-alt text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-white">
                            Panel de Administración
                        </h1>
                        <p class="text-red-100 text-lg">Control total de pro fitness</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-3">
                            <div class="text-sm text-white bg-white bg-opacity-20 px-3 py-1 rounded-lg">
                                <i class="fas fa-calendar-alt mr-2"></i>{{ now()->format('d/m/Y H:i') }}
                            </div>
                            <div class="text-sm text-white bg-white bg-opacity-20 px-3 py-1 rounded-lg">
                                <i class="fas fa-user-shield mr-2"></i>{{ ucfirst(Auth::user()->role) }} - {{ Auth::user()->name }}
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Tarjetas de Estadísticas REALES -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <!-- Suplementos -->
            <div class="admin-card bg-white rounded-lg shadow-md border border-gray-200 p-6 animate-zoomIn delay-100">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <i class="fas fa-capsules text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Suplementos</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalSupplements }}</h3>
                        <p class="text-xs text-red-600 mt-1">
                            {{ $lowStockItems }} con stock bajo
                        </p>
                    </div>
                </div>
            </div>

            <!-- Ropa Deportiva -->
            <div class="admin-card bg-white rounded-lg shadow-md border border-gray-200 p-6 animate-zoomIn delay-200">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <i class="fas fa-tshirt text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Ropa Deportiva</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalSportsClothes }}</h3>
                        <p class="text-xs text-red-600 mt-1">
                            {{ $outOfStockItems }} agotados
                        </p>
                    </div>
                </div>
            </div>

            <!-- Cafetería -->
            <div class="admin-card bg-white rounded-lg shadow-md border border-gray-200 p-6 animate-zoomIn delay-300">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <i class="fas fa-coffee text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Productos Cafetería</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalCafeteriaProducts }}</h3>
                        <p class="text-xs text-red-600 mt-1">
                            {{ $totalProductsInInventory }} en inventario
                        </p>
                    </div>
                </div>
            </div>

            <!-- Valor Inventario -->
            <div class="admin-card bg-white rounded-lg shadow-md border border-gray-200 p-6 animate-zoomIn delay-400">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <i class="fas fa-dollar-sign text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Valor Inventario</p>
                        <h3 class="text-2xl font-bold text-gray-800">${{ number_format($totalInventoryValue, 0, ',', '.') }}</h3>
                        <p class="text-xs text-gray-600 mt-1">Valor total</p>
                    </div>
                </div>
            </div>

            <!-- Mensajes de Contacto -->
            <a href="{{ route('contacts.admin') }}" class="block admin-card bg-white rounded-lg shadow-md border border-gray-200 p-6 animate-zoomIn delay-500 hover:border-red-400">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg relative">
                        <i class="fas fa-envelope text-red-600 text-xl"></i>
                        @if($unreadContactMessages > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full animate-pulse">
                                {{ $unreadContactMessages }}
                            </span>
                        @endif
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Mensajes</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalContactMessages }}</h3>
                        <p class="text-xs text-red-600 mt-1">
                            {{ $unreadContactMessages }} sin leer
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Acciones Rápidas -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-8 animate-slideInLeft delay-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Acciones Rápidas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <a href="{{ route('cafeteria.admin') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg text-center transition duration-300">
                    <i class="fas fa-coffee mr-2"></i>Cafetería
                </a>
                <a href="{{ route('supplements.admin') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg text-center transition duration-300">
                    <i class="fas fa-capsules mr-2"></i>Suplementos
                </a>
                <a href="{{ route('sport_clothes.admin') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg text-center transition duration-300">
                    <i class="fas fa-tshirt mr-2"></i>Ropa
                </a>
                <a href="{{ route('trainers.admin') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg text-center transition duration-300">
                    <i class="fas fa-user-tie mr-2"></i>Entrenadores
                </a>
                <a href="{{ route('members.admin') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg text-center transition duration-300">
                    <i class="fas fa-id-card-alt mr-2"></i>Miembros
                </a>
            </div>
        </div>

        <!-- Acciones Rápidas - Gimnasio -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-8 animate-slideInLeft delay-300">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Gimnasio</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('machines.admin') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg text-center transition duration-300">
                    <i class="fas fa-dumbbell mr-2"></i>Máquinas y Equipos
                </a>
                <a href="{{ route('gym') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-3 rounded-lg text-center transition duration-300">
                    <i class="fas fa-eye mr-2"></i>Ver Gimnasio (Público)
                </a>
            </div>
        </div>

        <!-- Información General -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 animate-slideInLeft delay-400">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Bienvenido al Dashboard</h2>
            <p class="text-gray-600 mb-4">
                Desde aquí podrás gestionar todos los aspectos de tu gimnasio pro fitness: 
                productos de cafetería, suplementos, ropa deportiva y entrenadores.
            </p>
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <p class="text-red-800 text-sm">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Nuevo Sistema de Inventario:</strong> Todos los productos ahora están en un sistema unificado de inventario.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection