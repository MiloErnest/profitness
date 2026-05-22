<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - pro fitness</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-red-fitness {
            background-color: #DC2626;
        }
        .text-red-fitness {
            color: #DC2626;
        }
        .border-red-fitness {
            border-color: #DC2626;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo y Título -->
            <div class="text-center">
                <div class="flex justify-center items-center mb-6">
                    <img src="{{ asset('imagenes/logo.png') }}" alt="ProFitness Logo" class="w-16 h-16 rounded-lg object-cover">
                    <div class="ml-3">
                        <span class="text-3xl font-bold text-red-600">pro</span>
                        <span class="text-3xl font-bold text-gray-800">fitness</span>
                    </div>
                </div>
               <h2 class="text-3xl font-extrabold text-gray-900">
                  Bienvenido
               </h2>
                 <p class="mt-2 text-sm text-gray-600">
                  Inicia sesión para continuar
                 </p>

            </div>

            <!-- Formulario -->
           <form class="mt-8 space-y-6" method="POST" action="/login">
                @csrf
                
                <div class="rounded-md shadow-sm -space-y-px">
                    <!-- Email -->
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                               class="appearance-none rounded-t-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm"
                               placeholder="Correo electrónico" value="{{ old('email') }}">
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="sr-only">Contraseña</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="appearance-none rounded-b-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm"
                               placeholder="Contraseña">
                    </div>
                </div>

                <!-- Errores -->
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Botón -->
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-300">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-lock text-red-300 group-hover:text-red-400"></i>
                        </span>
                        Iniciar Sesión
                    </button>
                </div>

              
            </form>
        </div>
    </div>

    <!-- Footer Simple -->
    <footer class="fixed bottom-0 w-full py-4 bg-gray-900 text-white text-center">
        <div class="container mx-auto">
            <p class="text-sm">
                &copy; 2024 pro fitness. Sistema Administrativo.
            </p>
        </div>
    </footer>
</body>
</html>