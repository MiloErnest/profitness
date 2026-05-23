<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'profitness - Transforma tu Cuerpo, Transforma tu Vida')</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-red-fitness {
            background-color: #DC2626; /* Rojo energético */
        }
        .text-red-fitness {
            color: #DC2626;
        }
        .border-red-fitness {
            border-color: #DC2626;
        }
        .hover-red:hover {
            color: #DC2626;
        }
        .btn-red {
            background-color: #DC2626;
            color: white;
        }
        .btn-red:hover {
            background-color: #B91C1C;
        }
        
        /* Estilos mejorados para el dropdown */
        .dropdown-container {
            position: relative;
        }
        
        .dropdown-menu {
            position: absolute;
            left: 0;
            top: 100%;
            margin-top: 8px; /* Espacio entre el botón y el menú */
            width: 200px;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 50;
        }
        
        .dropdown-container:hover .dropdown-menu,
        .dropdown-menu:hover {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        /* Triángulo decorativo en la parte superior del menú */
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 20px;
            width: 12px;
            height: 12px;
            background-color: white;
            transform: rotate(45deg);
            border-top: 1px solid #e5e7eb;
            border-left: 1px solid #e5e7eb;
        }
        
        .dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: #374151;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }
        
        .dropdown-item:first-child {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }
        
        .dropdown-item:last-child {
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header -->
    <nav class="bg-white shadow-lg border-b-2 border-red-500">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('imagenes/logo.png') }}" alt="ProFitness Logo" class="w-12 h-12 rounded-lg object-cover">
                    <div>
                        <span class="text-2xl font-bold text-red-600">pro</span>
                        <span class="text-2xl font-bold text-gray-800">fitness</span>
                    </div>
                </div>

                <!-- Navegación -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-red-600 font-semibold transition duration-300">
                        Inicio
                    </a>

                    <a href="{{ route('gym') }}" class="text-gray-700 hover:text-red-600 font-semibold transition duration-300">
                        Gimnasio
                    </a>

                    <!-- Dropdown TIENDA - VERSIÓN CORREGIDA -->
                    <div class="dropdown-container">
                        <button class="text-gray-700 hover:text-red-600 font-semibold transition duration-300 flex items-center gap-1 focus:outline-none">
                            Tienda
                            <i class="fas fa-chevron-down text-sm mt-0.5"></i>
                        </button>

                        <!-- Submenú desplegable -->
                        <div class="dropdown-menu">
                            <a href="{{ route('supplements') }}" class="dropdown-item">
                                Suplementos
                            </a>
                            <a href="{{ route('clothes') }}" class="dropdown-item">
                                Ropa deportiva
                            </a>
                        </div>
                    </div>

               <a href="{{ route('cafeteria.index') }}" class="text-gray-700 hover:text-red-600 font-semibold transition duration-300">

                        Cafetería
                    </a>

                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-red-600 font-semibold transition duration-300">
                        Contacto
                    </a>
                </div>

                <!-- Botón de Login / Dashboard -->
                <div class="flex items-center">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300 font-semibold">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <div class="flex items-center gap-2">
                                <a href="{{ route('user.dashboard') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300 font-semibold">
                                    <i class="fas fa-user-circle mr-2"></i>Volver a mi panel
                                </a>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300 font-semibold">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300 font-semibold">
                            <i class="fas fa-sign-in-alt mr-2"></i>Log In
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo y Descripción -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('imagenes/logo.png') }}" alt="ProFitness Logo" class="w-14 h-14 rounded-lg object-cover">
                        <div>
                            <span class="text-2xl font-bold text-red-500">pro</span>
                            <span class="text-2xl font-bold text-white">fitness</span>
                        </div>
                    </div>

                    <p class="text-gray-300 mb-4">
                        Transformamos vidas a través del fitness. Únete a nuestra comunidad y alcanza tus metas.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/pro.fitness_gym/" target="_blank" class="bg-red-600 hover:bg-red-700 text-white p-3 rounded-full transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/573124094665" target="_blank" class="bg-red-600 hover:bg-red-700 text-white p-3 rounded-full transition duration-300">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Enlaces Rápidos -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-red-500">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition">Inicio</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition">Quiénes Somos</a></li>
                        <li><a href="{{ route('gym') }}" class="text-gray-300 hover:text-white transition">Servicios</a></li>
                        <li><a href="{{ route('online-training') }}" class="text-gray-300 hover:text-white transition">Entrenamiento Online</a></li>
                    </ul>
                </div>

                <!-- Contacto Footer -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-red-500">Contacto</h3>
                    <div class="space-y-2 text-gray-300">
                        <p><i class="fas fa-map-marker-alt text-red-500 mr-2"></i> Calle 5 # 31 - 100 la Primavera , Ocaña. Frente al Estadio Hermidez Padilla</p>
                        <p><i class="fas fa-phone text-red-500 mr-2"></i> +57 312 4094665</p>
                        <p><i class="fas fa-envelope text-red-500 mr-2"></i> info@pro-fitness.com</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 ProFitness. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>