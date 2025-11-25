@extends('layouts.app')

@section('title', 'Mi Dashboard - pro fitness')

@section('content')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .animate-scaleIn {
        animation: scaleIn 0.5s ease-out forwards;
    }

    .animate-slideInRight {
        animation: slideInRight 0.6s ease-out forwards;
    }

    .animate-bounce {
        animation: bounce 2s infinite;
    }

    .animate-pulse {
        animation: pulse 2s infinite;
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

    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-red-50 to-gray-50">
    <!-- Hero Section con animación -->
    <div class="bg-gradient-to-r from-red-600 to-red-800 text-white py-16 animate-fadeInUp">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">¡Bienvenido, {{ $user->name }}! 👋</h1>
                    <p class="text-xl text-red-100">Tu camino hacia una mejor versión de ti mismo</p>
                </div>
                <div class="animate-bounce">
                    <i class="fas fa-dumbbell text-6xl opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    @if($member && !is_null($remainingDays) && $remainingDays <= 0)
        <div id="membership-expired-alert" class="fixed inset-0 z-50 flex items-center justify-center bg-red-900 bg-opacity-95 px-4">
            <div class="w-full max-w-xl bg-red-100 border border-red-600 text-red-900 rounded-2xl shadow-2xl p-8 md:p-10 animate-scaleIn">
                <div class="flex flex-col items-center text-center space-y-4">
                    <i class="fas fa-exclamation-triangle text-5xl"></i>
                    <h2 class="text-2xl md:text-3xl font-extrabold">Tu plan ha vencido</h2>
                    <p class="text-sm md:text-base">
                        Tu membresía terminó el
                        {{ \Carbon\Carbon::parse($member->end_date)->format('d/m/Y') }}.
                    </p>
                    <p class="text-sm md:text-base text-red-800">
                        Por favor acércate a recepción para renovarla y seguir registrando tus asistencias.
                    </p>
                    <div class="flex flex-col sm:flex-row sm:justify-center gap-3 pt-4">
                        <button type="button"
                            onclick="document.getElementById('membership-expired-alert').classList.add('hidden')"
                            class="px-5 py-2 rounded-lg bg-white text-red-700 font-semibold hover:bg-red-50 transition">
                            Cerrar mensaje
                        </button>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-5 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mx-auto px-4 py-12">
        <!-- Mensajes de éxito/info -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-lg animate-scaleIn">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-2xl mr-3"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-lg shadow-lg animate-scaleIn">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-2xl mr-3"></i>
                    <p class="font-semibold">{{ session('info') }}</p>
                </div>
            </div>
        @endif

        @if($member && !is_null($remainingDays) && $remainingDays > 0 && $remainingDays <= 3)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-6 rounded-lg shadow-lg animate-scaleIn">
                <div class="flex items-center">
                    <i class="fas fa-clock text-2xl mr-3"></i>
                    <div>
                        <p class="font-bold">Tu plan está por vencer</p>
                        <p class="text-sm">
                            Te quedan {{ $remainingDays }} día{{ $remainingDays === 1 ? '' : 's' }} de membresía.
                            Considera renovarlo pronto.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <!-- Total Asistencias -->
            <div class="stat-card bg-white rounded-2xl shadow-xl p-6 animate-fadeInUp delay-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-1">Asistencias Totales</p>
                        <h3 class="text-4xl font-bold text-gray-800">{{ $totalAttendances }}</h3>
                        <p class="text-sm text-gray-500 mt-1">¡Sigue así!</p>
                    </div>
                    <div class="bg-red-100 p-4 rounded-full">
                        <i class="fas fa-calendar-check text-red-600 text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Asistencias Este Mes -->
            <div class="stat-card bg-white rounded-2xl shadow-xl p-6 animate-fadeInUp delay-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-1">Este Mes</p>
                        <h3 class="text-4xl font-bold text-gray-800">{{ $currentMonthAttendances }}</h3>
                        <p class="text-sm text-gray-500 mt-1">días de entrenamiento</p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full">
                        <i class="fas fa-fire text-blue-600 text-3xl animate-pulse"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del Plan -->
        @if($member && $member->membershipPlan)
        <div class="bg-gradient-to-r from-red-600 to-red-800 rounded-2xl shadow-xl p-8 mb-12 animate-fadeInUp delay-400">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-white">
                <div>
                    <p class="text-red-100 text-sm font-semibold mb-2">Plan Activo</p>
                    <h3 class="text-3xl font-bold">{{ $member->membershipPlan->name }}</h3>
                </div>
                <div>
                    <p class="text-red-100 text-sm font-semibold mb-2">Duración</p>
                    <h3 class="text-3xl font-bold">{{ $member->membershipPlan->duration_days }} días</h3>
                </div>
                <div>
                    <p class="text-red-100 text-sm font-semibold mb-2">Fecha de Vencimiento</p>
                    <h3 class="text-3xl font-bold">{{ \Carbon\Carbon::parse($member->end_date)->format('d/m/Y') }}</h3>
                </div>
            </div>
            @if($member->membershipPlan->description)
            <div class="mt-4 pt-4 border-t border-red-400">
                <p class="text-red-100">{{ $member->membershipPlan->description }}</p>
            </div>
            @endif
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Registrar Asistencia -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl p-8 animate-slideInRight delay-400">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-check-circle text-red-600 mr-3"></i>
                        Registrar Hoy
                    </h2>

                    @if($todayAttendance)
                        <div class="text-center py-8">
                            <i class="fas fa-check-circle text-green-500 text-6xl mb-4 animate-bounce"></i>
                            <p class="text-xl font-bold text-gray-800 mb-2">¡Ya registraste tu asistencia!</p>
                            <p class="text-gray-600">Hora: {{ $todayAttendance->check_in_time->format('h:i A') }}</p>
                        </div>
                    @else
                        <form action="{{ route('user.attendance') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Notas (opcional)</label>
                                <textarea 
                                    name="notes" 
                                    rows="3" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                    placeholder="¿Cómo te sientes hoy?"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-bold py-4 px-6 rounded-lg hover:from-red-700 hover:to-red-800 transform hover:scale-105 transition duration-300 shadow-lg">
                                <i class="fas fa-check mr-2"></i>Marcar Asistencia
                            </button>
                        </form>

                        <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                            <p class="text-sm text-red-700">
                                <i class="fas fa-info-circle mr-2"></i>
                                Registra tu asistencia cada día que vengas al gym
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Historial de Asistencias -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl p-8 animate-fadeInUp delay-300">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-history text-red-600 mr-3"></i>
                        Historial de Asistencias
                    </h2>

                    @if($recentAttendances->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentAttendances as $attendance)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="flex items-center space-x-4">
                                        <div class="bg-red-100 p-3 rounded-full">
                                            <i class="fas fa-calendar-day text-red-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $attendance->attendance_date->format('d/m/Y') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $attendance->attendance_date->locale('es')->isoFormat('dddd') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">{{ $attendance->check_in_time->format('h:i A') }}</p>
                                        @if($attendance->notes)
                                            <p class="text-xs text-gray-500 italic">{{ Str::limit($attendance->notes, 30) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-calendar-times text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-600 text-lg">Aún no tienes asistencias registradas</p>
                            <p class="text-gray-500">¡Empieza hoy tu camino al fitness!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Motivación -->
        <div class="mt-12 bg-gradient-to-r from-red-600 via-red-700 to-red-800 rounded-2xl shadow-2xl p-12 text-center text-white animate-scaleIn delay-400">
            <i class="fas fa-trophy text-6xl mb-4 animate-bounce"></i>
            <h3 class="text-3xl font-bold mb-4">¡Sigue Adelante!</h3>
            <p class="text-xl text-red-100 mb-2">Cada día que entrenas eres más fuerte</p>
            <p class="text-red-200">Tu esfuerzo de hoy es el éxito de mañana 💪</p>
        </div>
    </div>
</div>
@endsection
