<div class="group relative bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100">
    <!-- Imagen del producto -->
    <div class="relative w-full h-56 overflow-hidden">
        <img src="{{ asset('images/' . $item['img']) }}"
             alt="{{ $item['name'] }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">

        <!-- Etiqueta de categoría (opcional) -->
        @if(isset($item['category']))
            <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-medium px-2 py-1 rounded-full">
                {{ ucfirst($item['category']) }}
            </span>
        @endif
    </div>

    <!-- Contenido del producto -->
    <div class="p-4 flex flex-col justify-between h-44">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                {{ $item['name'] }}
            </h3>
            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $item['desc'] }}</p>
        </div>

        <div class="flex justify-between items-center mt-3">
            <span class="text-xl font-bold text-blue-600">{{ $item['price'] }}</span>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105">
                <i class="fa-solid fa-cart-shopping mr-1"></i> Agregar
            </button>
        </div>
    </div>

    <!-- Overlay animado opcional -->
    <div
        class="absolute inset-0 bg-blue-600/0 group-hover:bg-blue-600/10 transition duration-300 rounded-2xl pointer-events-none">
    </div>
</div>
