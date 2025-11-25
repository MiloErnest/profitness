<!-- Modal de pago -->
<div id="modalPago"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50 transition">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-3 overflow-hidden transform scale-95 transition-all duration-300">
        <!-- Encabezado -->
        <div class="bg-blue-600 text-white text-lg font-semibold px-6 py-3 flex justify-between items-center">
            <span>Finalizar compra</span>
            <button onclick="cerrarModalPago()" class="text-white hover:text-gray-200 text-xl">&times;</button>
        </div>

        <!-- Contenido -->
        <div class="p-6 space-y-4">
            <div class="flex items-center justify-between">
                <span class="font-medium text-gray-700">Producto:</span>
                <span id="modalProducto" class="text-gray-900 font-semibold">-</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="font-medium text-gray-700">Precio:</span>
                <span id="modalPrecio" class="text-blue-600 font-bold">-</span>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Método de pago:</label>
                <select id="modalMetodo"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="tarjeta">Tarjeta de crédito / débito</option>
                    <option value="efectivo">Efectivo en gimnasio</option>
                    <option value="transferencia">Transferencia bancaria</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label class="block text-gray-700 font-medium mb-1">Correo electrónico:</label>
                <input type="email" id="modalCorreo"
                       class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="tucorreo@example.com">
            </div>

            <button onclick="confirmarPago()"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-xl transition">
                Confirmar compra
            </button>
        </div>
    </div>
</div>

<script>
    function abrirModalPago(nombre, precio) {
        document.getElementById('modalProducto').textContent = nombre;
        document.getElementById('modalPrecio').textContent = precio;
        document.getElementById('modalPago').classList.remove('hidden');
        document.getElementById('modalPago').classList.add('flex');
    }

    function cerrarModalPago() {
        document.getElementById('modalPago').classList.add('hidden');
        document.getElementById('modalPago').classList.remove('flex');
    }

    function confirmarPago() {
        const producto = document.getElementById('modalProducto').textContent;
        const correo = document.getElementById('modalCorreo').value.trim();

        if (correo === "") {
            alert("Por favor, ingresa tu correo electrónico.");
            return;
        }

        cerrarModalPago();
        alert(`✅ Compra confirmada para "${producto}". Gracias por tu pedido.`);
    }
</script>
