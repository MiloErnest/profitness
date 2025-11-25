@extends('layouts.app')

@section('title', 'Contacto - pro fitness')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-red-600 to-red-800 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Contáctanos</h1>
            <p class="text-xl text-red-100">Estamos aquí para ayudarte a alcanzar tus objetivos</p>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Formulario de Contacto -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Envíanos un mensaje</h2>
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        <p class="font-semibold">¡Mensaje enviado!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre completo</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                               placeholder="Tu nombre">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                               placeholder="tu@email.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Teléfono</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                               placeholder="+57 312 4094665">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-gray-700 font-semibold mb-2">Asunto</label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                               placeholder="¿En qué podemos ayudarte?">
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 font-semibold mb-2">Mensaje</label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="5" 
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                  placeholder="Escribe tu mensaje aquí..."></textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="w-full bg-red-600 text-white font-bold py-4 px-6 rounded-lg hover:bg-red-700 transform hover:scale-105 transition duration-300 shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>Enviar Mensaje
                    </button>
                </form>
            </div>

            <!-- Información de Contacto -->
            <div class="space-y-8">
                <!-- Ubicación -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-red-100 p-4 rounded-full">
                            <i class="fas fa-map-marker-alt text-red-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Ubicación</h3>
                            <p class="text-gray-600">Calle 5 # 31 - 100 la Primavera, Ocaña</p>
                            <p class="text-gray-600">Frente al Estadio Hermidez Padilla</p>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-4 rounded-full">
                            <i class="fab fa-whatsapp text-green-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">WhatsApp</h3>
                            <a href="https://wa.me/573124094665" target="_blank" class="text-green-600 hover:text-green-700 font-semibold text-lg">
                                +57 312 4094665
                            </a>
                            <p class="text-gray-600 text-sm mt-1">Haz clic para chatear con nosotros</p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-100 p-4 rounded-full">
                            <i class="fas fa-envelope text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Email</h3>
                            <a href="mailto:info@pro-fitness.com" class="text-blue-600 hover:text-blue-700 font-semibold">
                                info@pro-fitness.com
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Horarios -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-purple-100 p-4 rounded-full">
                            <i class="fas fa-clock text-purple-600 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Horarios de Atención</h3>
                            <div class="space-y-2 text-gray-600">
                                <div class="flex justify-between">
                                    <span class="font-semibold">Lunes - Viernes:</span>
                                    <span>5:00 AM - 10:00 PM</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Sábados:</span>
                                    <span>6:00 AM - 8:00 PM</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Domingos:</span>
                                    <span>7:00 AM - 2:00 PM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Redes Sociales -->
                <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-2xl shadow-xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-4">Síguenos en Instagram</h3>
                    <p class="mb-6 text-red-100">Mantente al día con nuestras últimas actualizaciones, tips de entrenamiento y motivación diaria.</p>
                    <a href="https://www.instagram.com/pro.fitness_gym/" 
                       target="_blank"
                       class="inline-flex items-center bg-white text-red-600 font-bold py-3 px-6 rounded-lg hover:bg-red-50 transition duration-300">
                        <i class="fab fa-instagram text-2xl mr-3"></i>
                        @pro.fitness_gym
                    </a>
                </div>
            </div>
        </div>

        <!-- Mapa (Opcional - puedes reemplazar el src con tu ubicación real) -->
        <div class="mt-12">
            <div class="bg-white rounded-2xl shadow-xl p-4">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 px-4">Encuéntranos</h3>
                <div class="rounded-xl overflow-hidden" style="height: 400px;">
                    <iframe 
                        src="https://www.google.com/maps?q=8.259378781516155,-73.36051861885839&z=16&hl=es&output=embed"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
