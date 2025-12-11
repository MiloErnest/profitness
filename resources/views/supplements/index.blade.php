@extends('layouts.app')

@section('title', 'Suplementos | Pro.Fitness')

@section('content')

<!-- HERO -->
<section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white py-20 text-center">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-3 uppercase tracking-widest">Suplementos</h1>
        <p class="text-md md:text-lg max-w-2xl mx-auto text-white/90">
            Potencia tus resultados con nuestra selección de suplementos premium.
        </p>
    </div>
</section>

<!-- CONTENEDOR PRINCIPAL -->
<section class="py-12 bg-gradient-to-b from-white via-red-50 to-red-100">
    <div class="container mx-auto px-6">

        <!-- MENU DE CATEGORIAS -->
        <div class="mb-8">
            <nav id="supp-categories" class="flex gap-3 overflow-x-auto py-2 px-1">
                <!-- Botones de categoría dinámicos -->
                <button onclick="cambiarCategoria('todos')" class="cat-btn active-cat px-4 py-2 rounded-full font-semibold whitespace-nowrap border-2 border-red-200 bg-white text-red-700 shadow-sm">Todos</button>
                @php
                    $categories = $supplements->pluck('category')->unique();
                @endphp
                @foreach($categories as $category)
                    <button onclick="cambiarCategoria('{{ Str::slug($category) }}')" class="cat-btn px-4 py-2 rounded-full font-semibold whitespace-nowrap border-2 border-transparent text-red-600 hover:border-red-200">{{ $category }}</button>
                @endforeach
            </nav>

            <!-- linea separadora -->
            <div class="h-px bg-red-100 rounded-full"></div>
        </div>

        <!-- CONTENIDO DE PRODUCTOS DESDE BASE DE DATOS -->
        <div id="supp-products" class="space-y-12">

            <!-- TODOS LOS PRODUCTOS -->
            <div id="section-todos" class="product-section grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($supplements as $supplement)
                    <div class="bg-white border border-red-200 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                        @if($supplement->image)
                            <img src="{{ asset('storage/' . $supplement->image) }}" alt="{{ $supplement->name }}" class="w-full h-56 object-cover">
                        @else
                            <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-capsules text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-bold text-red-700 mb-1">{{ $supplement->name }}</h3>
                            <p class="text-red-600 font-semibold mb-3">${{ number_format($supplement->price, 0, ',', '.') }}</p>
                            @if($supplement->description)
                                <p class="text-sm text-gray-600 mb-4">{{ Str::limit($supplement->description, 80) }}</p>
                            @endif
                            <div class="mb-3">
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $supplement->category }}
                                </span>
                                @if($supplement->stock < 5)
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium ml-1">
                                        Stock: {{ $supplement->stock }}
                                    </span>
                                @endif
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="type" value="supplement">
                                <input type="hidden" name="id" value="{{ $supplement->id }}">
                                <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white px-4 py-2 rounded-lg font-semibold hover:from-red-700 hover:to-red-800 transition">
                                    Agregar al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12">
                        <i class="fas fa-capsules text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-xl">No hay suplementos disponibles en este momento</p>
                        <p class="text-gray-400 mt-2">Próximamente tendremos nuevos productos</p>
                    </div>
                @endforelse
            </div>

            <!-- SECCIONES POR CATEGORÍA -->
            @foreach($categories as $category)
                <div id="section-{{ Str::slug($category) }}" class="product-section hidden grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($supplements->where('category', $category) as $supplement)
                        <div class="bg-white border border-red-200 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                            @if($supplement->image)
                                <img src="{{ asset('storage/' . $supplement->image) }}" alt="{{ $supplement->name }}" class="w-full h-56 object-cover">
                            @else
                                <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-capsules text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                            <div class="p-4 text-center">
                                <h3 class="text-lg font-bold text-red-700 mb-1">{{ $supplement->name }}</h3>
                                <p class="text-red-600 font-semibold mb-3">${{ number_format($supplement->price, 0, ',', '.') }}</p>
                                @if($supplement->description)
                                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($supplement->description, 80) }}</p>
                                @endif
                                <div class="mb-3">
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $supplement->category }}
                                    </span>
                                    @if($supplement->stock < 5)
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium ml-1">
                                            Stock: {{ $supplement->stock }}
                                        </span>
                                    @endif
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="type" value="supplement">
                                    <input type="hidden" name="id" value="{{ $supplement->id }}">
                                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white px-4 py-2 rounded-lg font-semibold hover:from-red-700 hover:to-red-800 transition">
                                        Agregar al carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div> <!-- /#supp-products -->

    </div>
</section>

<!-- Resto del código se mantiene igual (CTA, Modal, JavaScript) -->
<!-- CTA -->
<section class="py-16 bg-gradient-to-r from-red-500 via-red-600 to-red-700 text-white text-center">
    <div class="container mx-auto px-6">
        <h3 class="text-2xl font-bold mb-3">¿No encuentras lo que buscas?</h3>
        <p class="mb-6 text-white/90">Contáctanos y te ayudamos a conseguir el suplemento que necesites.</p>
        <a href="https://wa.me/573124094665?text=Hola,%20me%20gustaría%20recibir%20asesoría%20sobre%20sus%20suplementos%20deportivos" 
           target="_blank"
           class="inline-block bg-white text-red-700 px-6 py-2 rounded-lg font-semibold hover:bg-red-100 transition">
            Contactar por WhatsApp
        </a>
    </div>
</section>

<!-- MODAL DE PAGO -->
<div id="modalPago" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-red-700">Completar Compra</h3>
            <button onclick="cerrarModalPago()" class="text-gray-500 hover:text-red-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="mb-4">
            <p class="text-gray-600">Producto: <span id="modalProducto" class="font-semibold"></span></p>
            <p class="text-gray-600">Precio: <span id="modalPrecio" class="font-semibold text-red-600"></span></p>
        </div>

        <form id="formPago" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                <input type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="tel" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección de envío</label>
                <textarea required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button type="button" onclick="cerrarModalPago()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-semibold hover:from-red-700 hover:to-red-800 transition">
                    Pagar Ahora
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
// Función global para cambiar categoría
function cambiarCategoria(categoria) {
    console.log('Cambiando a categoría:', categoria);
    
    // Ocultar todas las secciones
    document.querySelectorAll('.product-section').forEach(seccion => {
        seccion.classList.add('hidden');
    });
    
    // Mostrar la sección seleccionada
    const seccionActiva = document.getElementById('section-' + categoria);
    if (seccionActiva) {
        seccionActiva.classList.remove('hidden');
    }
    
    // Actualizar todos los botones
    document.querySelectorAll('.cat-btn').forEach(boton => {
        boton.classList.remove('border-red-200', 'bg-white', 'text-red-700', 'shadow-sm', 'active-cat');
        boton.classList.add('border-transparent', 'text-red-600');
    });
    
    // Activar el botón clickeado
    document.querySelectorAll('.cat-btn').forEach(boton => {
        if (boton.textContent.trim().toLowerCase().includes(categoria) || (categoria === 'todos' && boton.textContent.trim() === 'Todos')) {
            boton.classList.remove('border-transparent', 'text-red-600');
            boton.classList.add('border-red-200', 'bg-white', 'text-red-700', 'shadow-sm', 'active-cat');
        }
    });
    
    // Scroll suave
    const productsTop = document.getElementById('supp-products').offsetTop - 100;
    window.scrollTo({ top: productsTop, behavior: 'smooth' });
}

// Funciones para el modal de pago
function abrirModalPago(producto, precio) {
    document.getElementById('modalProducto').textContent = producto;
    document.getElementById('modalPrecio').textContent = precio;
    document.getElementById('modalPago').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function cerrarModalPago() {
    document.getElementById('modalPago').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Manejar el formulario de pago
document.getElementById('formPago').addEventListener('submit', function(e) {
    e.preventDefault();
    // Aquí iría la lógica de procesamiento de pago
    alert('¡Compra realizada con éxito! Te contactaremos para coordinar el envío.');
    cerrarModalPago();
});

// Inicializar con todos los productos al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    cambiarCategoria('todos');
});

// Cerrar modal al hacer clic fuera
document.getElementById('modalPago').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalPago();
    }
});
</script>

@endsection