@extends('layouts.app')

@section('title', 'Ropa Deportiva | Pro.Fitness')

@section('content')

<!-- HERO -->
<section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white py-20 text-center">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-3 uppercase tracking-widest">Ropa Deportiva</h1>
        <p class="text-md md:text-lg max-w-2xl mx-auto text-white/90">
            Elige tu estilo y rinde al máximo con nuestras prendas deportivas premium.
        </p>
    </div>
</section>

<!-- CONTENEDOR PRINCIPAL -->
<section class="py-12 bg-gradient-to-b from-white via-red-50 to-red-100">
    <div class="container mx-auto px-6">

        @if($products->isEmpty())
            <div class="text-center py-16">
                <i class="fas fa-tshirt text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-xl">No hay productos disponibles en este momento</p>
                <p class="text-gray-400 mt-2">Próximamente tendremos nuevos productos</p>
            </div>
        @else
            <!-- MENÚ PRINCIPAL DE GÉNERO -->
            <div class="text-center mb-10">
                <button onclick="mostrarGenero('hombre')" 
                        id="btnHombre"
                        class="mx-2 px-6 py-2 rounded-full font-semibold transition bg-gradient-to-r from-red-700 to-red-800 text-white shadow-md hover:shadow-lg">
                    Hombre
                </button>
                <button onclick="mostrarGenero('mujer')" 
                        id="btnMujer"
                        class="mx-2 px-6 py-2 rounded-full font-semibold transition bg-gradient-to-r from-red-200 via-red-100 to-white text-red-700 shadow-md hover:shadow-lg">
                    Mujer
                </button>
            </div>

            <!-- MENÚ DE SUBCATEGORÍAS (se generará dinámicamente) -->
            <div id="menuSubcategorias" class="mb-8 text-center hidden">
                <nav id="navCategorias" class="flex flex-wrap justify-center gap-3">
                    <!-- Se generará dinámicamente con JavaScript -->
                </nav>
                <div class="h-px bg-red-100 mt-3 rounded-full"></div>
            </div>

            <!-- CONTENIDO DE PRODUCTOS -->
            <div id="contenedorProductos" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Aquí se insertan dinámicamente los productos -->
            </div>
        @endif

    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-gradient-to-r from-red-500 via-red-600 to-red-700 text-white text-center">
    <div class="container mx-auto px-6">
        <h3 class="text-2xl font-bold mb-3">¿Buscas algo específico?</h3>
        <p class="mb-6 text-white/90">Contáctanos y te ayudamos a encontrar la prenda deportiva ideal para ti.</p>
        <a href="https://wa.me/573124094665?text=Hola,%20quisiera%20consultar%20sobre%20la%20ropa%20deportiva%20de%20ProFitness" 
           target="_blank"
           class="inline-block bg-white text-red-700 px-6 py-2 rounded-lg font-semibold hover:bg-red-100 transition">
            Contactar por WhatsApp
        </a>
    </div>
</section>

<!-- MODAL DE PAGO -->
@include('partials.modal_pago')

<!-- SCRIPT -->
<script>
    // Productos desde la base de datos
    const productos = @json($products);

    // Organizar productos por género y categoría
    const productosOrganizados = {
        hombre: {},
        mujer: {}
    };

    productos.forEach(producto => {
        // Normalizar género a minúsculas y asegurar que sea válido
        let genero = (producto.gender || 'hombre').toLowerCase().trim();
        if (genero !== 'hombre' && genero !== 'mujer') {
            genero = 'hombre';
        }
        
        const categoria = (producto.category || 'otros').toLowerCase().trim();
        
        // Solo agregar el producto al género correspondiente
        if (!productosOrganizados[genero]) {
            productosOrganizados[genero] = {};
        }
        
        if (!productosOrganizados[genero][categoria]) {
            productosOrganizados[genero][categoria] = [];
        }
        
        productosOrganizados[genero][categoria].push(producto);
    });

    let generoActual = null;
    let categoriaActual = null;

    function mostrarGenero(genero) {
        // Normalizar el género seleccionado
        generoActual = genero.toLowerCase().trim();
        if (generoActual !== 'hombre' && generoActual !== 'mujer') {
            generoActual = 'hombre';
        }
        
        document.getElementById('menuSubcategorias').classList.remove('hidden');
        
        // Generar botones de categoría dinámicamente SOLO para el género seleccionado
        const navCategorias = document.getElementById('navCategorias');
        navCategorias.innerHTML = '';
        
        // Solo obtener categorías del género seleccionado
        const categorias = Object.keys(productosOrganizados[generoActual] || {});
        
        if (categorias.length > 0) {
            categorias.forEach((cat, index) => {
                const btn = document.createElement('button');
                btn.onclick = () => cambiarSubcategoria(cat);
                btn.className = `sub-btn px-4 py-2 rounded-full font-semibold border-2 ${index === 0 ? 'border-red-200 bg-white text-red-700 shadow-sm active-sub' : 'border-transparent text-red-600 hover:border-red-200'}`;
                btn.textContent = cat.charAt(0).toUpperCase() + cat.slice(1);
                navCategorias.appendChild(btn);
            });
            
            // Mostrar primera categoría del género seleccionado
            cambiarSubcategoria(categorias[0]);
        } else {
            // Si no hay categorías para este género, mostrar mensaje
            document.getElementById('contenedorProductos').innerHTML = '<div class="col-span-4 text-center py-12 text-gray-500">No hay productos disponibles para este género</div>';
        }

        // Cambiar estilos de botones de género
        document.getElementById('btnHombre').className = generoActual === 'hombre' 
            ? 'mx-2 px-6 py-2 rounded-full font-semibold transition bg-gradient-to-r from-red-700 to-red-800 text-white shadow-md hover:shadow-lg'
            : 'mx-2 px-6 py-2 rounded-full font-semibold transition bg-gradient-to-r from-red-200 via-red-100 to-white text-red-700 shadow-md hover:shadow-lg';
        
        document.getElementById('btnMujer').className = generoActual === 'mujer'
            ? 'mx-2 px-6 py-2 rounded-full font-semibold transition bg-gradient-to-r from-red-700 to-red-800 text-white shadow-md hover:shadow-lg'
            : 'mx-2 px-6 py-2 rounded-full font-semibold transition bg-gradient-to-r from-red-200 via-red-100 to-white text-red-700 shadow-md hover:shadow-lg';
    }

    function cambiarSubcategoria(subcat) {
        categoriaActual = subcat.toLowerCase().trim();
        const contenedor = document.getElementById('contenedorProductos');
        contenedor.innerHTML = '';

        // Asegurar que solo se muestren productos del género seleccionado
        if (!generoActual) {
            contenedor.innerHTML = '<div class="col-span-4 text-center py-12 text-gray-500">Selecciona un género primero</div>';
            return;
        }

        const generoNormalizado = generoActual.toLowerCase().trim();
        const categoriaNormalizada = subcat.toLowerCase().trim();

        // Verificar que existan productos para este género y categoría
        if (!productosOrganizados[generoNormalizado] || !productosOrganizados[generoNormalizado][categoriaNormalizada]) {
            contenedor.innerHTML = '<div class="col-span-4 text-center py-12 text-gray-500">No hay productos en esta categoría</div>';
            return;
        }

        // Obtener productos SOLO del género seleccionado
        let productosCategoria = productosOrganizados[generoNormalizado][categoriaNormalizada] || [];

        // Filtro adicional para asegurar que solo se muestren productos del género correcto
        productosCategoria = productosCategoria.filter(item => {
            const itemGender = (item.gender || 'hombre').toLowerCase().trim();
            return itemGender === generoNormalizado;
        });

        if (productosCategoria.length === 0) {
            contenedor.innerHTML = '<div class="col-span-4 text-center py-12 text-gray-500">No hay productos en esta categoría</div>';
            return;
        }

        productosCategoria.forEach(item => {
            const precioFormateado = '$' + new Intl.NumberFormat('es-CO').format(Math.round(item.price));
            const imagen = item.image || '';
            const descripcion = item.description || 'Producto de calidad premium';
            const nombreEscapado = item.name.replace(/'/g, "\\'");
            
            const card = `
                <div class="bg-white border border-red-200 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                    ${imagen 
                        ? `<img src="${imagen}" alt="${item.name}" class="w-full h-56 object-cover">`
                        : `<div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-tshirt text-gray-400 text-4xl"></i>
                           </div>`
                    }
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-bold text-red-700 mb-1">${item.name}</h3>
                        <p class="text-red-600 font-semibold mb-3">${precioFormateado}</p>
                        <p class="text-sm text-gray-600 mb-4">${descripcion.substring(0, 80)}${descripcion.length > 80 ? '...' : ''}</p>
                        ${item.stock > 0 
                            ? `<button onclick="agregarRopaAlCarrito(${item.id})" 
                                      class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white px-4 py-2 rounded-lg font-semibold hover:from-red-700 hover:to-red-800 transition">
                                  Agregar al carrito
                              </button>`
                            : `<button disabled 
                                      class="w-full bg-gray-400 text-white px-4 py-2 rounded-lg font-semibold cursor-not-allowed">
                                  Agotado
                              </button>`
                        }
                    </div>
                </div>`;
            contenedor.innerHTML += card;
        });

        // Cambiar estilo del botón activo
        document.querySelectorAll('.sub-btn').forEach(b => {
            b.classList.remove('border-red-200', 'bg-white', 'text-red-700', 'shadow-sm', 'active-sub');
            b.classList.add('border-transparent', 'text-red-600');
        });

        const btnActivo = Array.from(document.querySelectorAll('.sub-btn')).find(b => 
            b.textContent.trim().toLowerCase() === subcat
        );
        if (btnActivo) {
            btnActivo.classList.remove('border-transparent', 'text-red-600');
            btnActivo.classList.add('border-red-200', 'bg-white', 'text-red-700', 'shadow-sm', 'active-sub');
        }
    }

    async function agregarRopaAlCarrito(id) {
        try {
            const response = await fetch(`{{ route('cart.add') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    type: 'sport_cloth',
                    id: id,
                    qty: 1,
                }),
            });

            if (!response.ok) {
                throw new Error('Error al agregar al carrito');
            }

            // Opcional: podrías mostrar un mensaje o actualizar un contador de carrito
            alert('Producto agregado al carrito');
        } catch (e) {
            alert('No se pudo agregar al carrito.');
        }
    }

    // Las funciones abrirModalPago y cerrarModalPago están definidas en el partial modal_pago
</script>

@endsection
