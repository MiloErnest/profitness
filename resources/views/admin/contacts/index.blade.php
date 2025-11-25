@extends('layouts.app')

@section('title', 'Mensajes de Contacto - pro fitness')

@section('content')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .message-card {
        animation: fadeIn 0.3s ease-out;
        transition: all 0.3s ease;
    }
    .message-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .unread {
        border-left: 4px solid #DC2626;
        background-color: #FEF2F2;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-600 to-red-800 shadow-2xl">
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 p-4 rounded-full">
                        <i class="fas fa-envelope text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-white">Mensajes de Contacto</h1>
                        <p class="text-red-100 text-lg">Gestiona las consultas de tus clientes</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-2 rounded-lg transition duration-300 font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>Volver al Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="fas fa-inbox text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total de Mensajes</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $messages->total() }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <i class="fas fa-envelope text-red-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Sin Leer</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $unreadCount }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Leídos</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $messages->total() - $unreadCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-xl mr-3"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Lista de Mensajes -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-list mr-2 text-red-600"></i>Todos los Mensajes
                </h2>
            </div>

            @if($messages->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($messages as $message)
                        <div class="message-card p-6 {{ $message->status === 'pending' ? 'unread' : '' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        @if($message->status === 'pending')
                                            <span class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">
                                                <i class="fas fa-circle text-xs mr-1"></i>Nuevo
                                            </span>
                                        @else
                                            <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">
                                                <i class="fas fa-check text-xs mr-1"></i>Leído
                                            </span>
                                        @endif
                                        <span class="text-sm text-gray-500">
                                            <i class="far fa-clock mr-1"></i>{{ $message->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <h3 class="text-lg font-bold text-gray-800 mb-2">
                                        <i class="fas fa-user-circle text-red-600 mr-2"></i>{{ $message->name }}
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-3">
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-envelope text-red-600 mr-2"></i>
                                            <a href="mailto:{{ $message->email }}" class="hover:text-red-600 transition">{{ $message->email }}</a>
                                        </p>
                                        @if($message->phone)
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-phone text-red-600 mr-2"></i>
                                                <a href="tel:{{ $message->phone }}" class="hover:text-red-600 transition">{{ $message->phone }}</a>
                                            </p>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-sm font-semibold text-gray-700 mb-1">
                                            <i class="fas fa-tag text-red-600 mr-2"></i>Asunto:
                                        </p>
                                        <p class="text-gray-800">{{ $message->subject }}</p>
                                    </div>

                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <p class="text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-comment-dots text-red-600 mr-2"></i>Mensaje:
                                        </p>
                                        <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
                                    </div>
                                </div>

                                <div class="ml-6 flex flex-col gap-2">
                                    @if($message->status === 'pending')
                                        <form action="{{ route('contacts.mark-read', $message->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap">
                                                <i class="fas fa-check mr-1"></i>Marcar Leído
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('contacts.destroy', $message->id) }}" method="POST" 
                                          onsubmit="return confirm('¿Estás seguro de eliminar este mensaje?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap">
                                            <i class="fas fa-trash mr-1"></i>Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $messages->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-600 text-lg">No hay mensajes de contacto</p>
                    <p class="text-gray-500">Los mensajes aparecerán aquí cuando los clientes se pongan en contacto</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
