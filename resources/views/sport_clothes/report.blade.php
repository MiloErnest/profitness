@extends('layouts.app')

@section('title', 'Reporte de Ropa Deportiva - Pro.Fitness')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        <i class="fas fa-chart-bar text-red-600 mr-2"></i>Reporte Detallado de Ropa Deportiva
                    </h2>
                    <p class="text-gray-600 mt-2">
                        Período: {{ $monthName }} {{ $currentYear }}
                        @if($currentYear == now()->year && $currentMonth == now()->month)
                            <span class="ml-3 bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-calendar-day mr-1"></i>Mes en Curso
                            </span>
                        @endif
                        @if($isClosed)
                            <span class="ml-3 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-lock mr-1"></i>Mes Cerrado
                            </span>
                        @else
                            <span class="ml-3 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-unlock mr-1"></i>Mes Activo
                            </span>
                        @endif
                    </p>
                </div>
                <div class="flex gap-3">
                    <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-print mr-2"></i>Imprimir
                    </button>
                    <a href="{{ route('sport_clothes.admin') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    <span>{{ session('info') }}</span>
                </div>
            </div>
        @endif

        <!-- Selector de Período -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form action="{{ route('sport_clothes.report') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-calendar-alt mr-1 text-red-600"></i>Mes
                    </label>
                    <select name="month" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="1" {{ $currentMonth == 1 ? 'selected' : '' }}>Enero</option>
                        <option value="2" {{ $currentMonth == 2 ? 'selected' : '' }}>Febrero</option>
                        <option value="3" {{ $currentMonth == 3 ? 'selected' : '' }}>Marzo</option>
                        <option value="4" {{ $currentMonth == 4 ? 'selected' : '' }}>Abril</option>
                        <option value="5" {{ $currentMonth == 5 ? 'selected' : '' }}>Mayo</option>
                        <option value="6" {{ $currentMonth == 6 ? 'selected' : '' }}>Junio</option>
                        <option value="7" {{ $currentMonth == 7 ? 'selected' : '' }}>Julio</option>
                        <option value="8" {{ $currentMonth == 8 ? 'selected' : '' }}>Agosto</option>
                        <option value="9" {{ $currentMonth == 9 ? 'selected' : '' }}>Septiembre</option>
                        <option value="10" {{ $currentMonth == 10 ? 'selected' : '' }}>Octubre</option>
                        <option value="11" {{ $currentMonth == 11 ? 'selected' : '' }}>Noviembre</option>
                        <option value="12" {{ $currentMonth == 12 ? 'selected' : '' }}>Diciembre</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-calendar mr-1 text-red-600"></i>Año
                    </label>
                    <input type="number" 
                           name="year" 
                           value="{{ $currentYear }}"
                           min="2020"
                           max="2100"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-300 font-semibold">
                        <i class="fas fa-search mr-2"></i>Ver Período
                    </button>
                </div>
                <div>
                    <a href="{{ route('sport_clothes.currentMonth') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg transition duration-300 font-semibold inline-block">
                        <i class="fas fa-calendar-day mr-2"></i>Mes Actual
                    </a>
                </div>
                @if(!$isClosed)
                    <div>
                        <button type="button" 
                                onclick="if(confirm('¿Estás seguro de cerrar el mes {{ $monthName }} {{ $currentYear }}? Esta acción guardará un reporte permanente.')) { document.getElementById('closeMonthForm').submit(); }"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-300 font-semibold">
                            <i class="fas fa-lock mr-2"></i>Cerrar Mes
                        </button>
                    </div>
                @else
                    <div>
                        <button type="button" 
                                onclick="if(confirm('¿Agregar productos nuevos al reporte de {{ $monthName }} {{ $currentYear }}?')) { document.getElementById('updateMonthForm').submit(); }"
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg transition duration-300 font-semibold">
                            <i class="fas fa-sync mr-2"></i>Actualizar Mes
                        </button>
                    </div>
                @endif
            </form>
            
            <!-- Formulario para cerrar mes (oculto) -->
            @if(!$isClosed)
                <form id="closeMonthForm" action="{{ route('sport_clothes.closeMonth') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="year" value="{{ $currentYear }}">
                    <input type="hidden" name="month" value="{{ $currentMonth }}">
                </form>
            @endif
            
            <!-- Formulario para actualizar mes (oculto) -->
            @if($isClosed)
                <form id="updateMonthForm" action="{{ route('sport_clothes.updateMonth') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="year" value="{{ $currentYear }}">
                    <input type="hidden" name="month" value="{{ $currentMonth }}">
                </form>
            @endif
            
            <!-- Botón para ver meses guardados -->
            @if($availableMonths->isNotEmpty())
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <button type="button" 
                            onclick="document.getElementById('savedMonthsModal').classList.remove('hidden')"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-folder-open mr-2"></i>Ver Meses Guardados ({{ $availableMonths->count() }})
                    </button>
                </div>
            @endif
        </div>

        <!-- Modal de Meses Guardados -->
        <div id="savedMonthsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[80vh] overflow-hidden flex flex-col">
                <!-- Header del Modal -->
                <div class="bg-purple-600 text-white p-6 flex justify-between items-center">
                    <h3 class="text-2xl font-bold">
                        <i class="fas fa-archive mr-2"></i>Reportes Guardados
                    </h3>
                    <button onclick="document.getElementById('savedMonthsModal').classList.add('hidden')" 
                            class="text-white hover:text-gray-200 text-3xl leading-none">
                        &times;
                    </button>
                </div>
                
                <!-- Contenido del Modal -->
                <div class="p-6 overflow-y-auto flex-1">
                    @if($monthsByYear->isNotEmpty())
                        @foreach($monthsByYear as $year => $months)
                            <div class="mb-6">
                                <div class="bg-gradient-to-r from-purple-100 to-blue-100 rounded-lg p-4 mb-3">
                                    <h4 class="text-xl font-bold text-gray-800">
                                        <i class="fas fa-calendar-alt mr-2 text-purple-600"></i>Año {{ $year }}
                                        <span class="text-sm font-normal text-gray-600 ml-2">({{ $months->count() }} mes{{ $months->count() != 1 ? 'es' : '' }})</span>
                                    </h4>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($months as $period)
                                        <div class="bg-white border-2 {{ $currentYear == $period['year'] && $currentMonth == $period['month'] ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-lg p-4 hover:shadow-md transition duration-200">
                                            <div class="flex items-center justify-between mb-2">
                                                <a href="{{ route('sport_clothes.report', ['year' => $period['year'], 'month' => $period['month']]) }}" 
                                                   class="flex-1 font-semibold text-gray-800 hover:text-red-600">
                                                    <i class="fas fa-file-alt mr-2 text-red-500"></i>{{ $period['label'] }}
                                                </a>
                                                <form action="{{ route('sport_clothes.deleteMonth') }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('¿Estás seguro de eliminar el reporte de {{ $period['label'] }}? Esta acción no se puede deshacer.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="year" value="{{ $period['year'] }}">
                                                    <input type="hidden" name="month" value="{{ $period['month'] }}">
                                                    <button type="submit" 
                                                            class="text-red-500 hover:text-red-700 ml-2"
                                                            title="Eliminar reporte">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            @if($currentYear == $period['year'] && $currentMonth == $period['month'])
                                                <span class="text-xs bg-red-500 text-white px-2 py-1 rounded-full">
                                                    <i class="fas fa-eye mr-1"></i>Visualizando
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3"></i>
                            <p>No hay reportes guardados todavía</p>
                        </div>
                    @endif
                </div>
                
                <!-- Footer del Modal -->
                <div class="bg-gray-100 p-4 flex justify-end">
                    <button onclick="document.getElementById('savedMonthsModal').classList.add('hidden')" 
                            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-times mr-2"></i>Cerrar
                    </button>
                </div>
            </div>
        </div>

        <!-- Resumen General -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm mb-1">Recibido Total</p>
                        <p class="text-3xl font-bold">{{ $products->sum('received') }}</p>
                        <p class="text-blue-100 text-xs mt-1">unidades</p>
                    </div>
                    <i class="fas fa-boxes text-4xl text-blue-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm mb-1">Vendido Total</p>
                        <p class="text-3xl font-bold">{{ $products->sum('sold') }}</p>
                        <p class="text-red-100 text-xs mt-1">unidades</p>
                    </div>
                    <i class="fas fa-shopping-cart text-4xl text-red-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm mb-1">Stock Actual</p>
                        <p class="text-3xl font-bold">{{ $products->sum('stock') }}</p>
                        <p class="text-green-100 text-xs mt-1">unidades</p>
                    </div>
                    <i class="fas fa-warehouse text-4xl text-green-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm mb-1">Valor Total</p>
                        <p class="text-2xl font-bold">
                            ${{ number_format($products->sum('total_value'), 0, ',', '.') }}
                        </p>
                        <p class="text-purple-100 text-xs mt-1">inventario</p>
                    </div>
                    <i class="fas fa-dollar-sign text-4xl text-purple-200"></i>
                </div>
            </div>
        </div>

        <!-- Tabla Detallada Estilo Excel -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-red-200 border-b-2 border-red-400">
                            <th colspan="10" class="px-4 py-3 text-center font-bold text-gray-800">
                                {{ $monthName }} {{ $currentYear }}
                                @if($isClosed)
                                    <span class="ml-2 text-green-700">(Mes Cerrado)</span>
                                @endif
                            </th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 border border-gray-300">PRODUCTO</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300 bg-pink-100">GÉNERO</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300 bg-blue-100">RECIBIDO</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300 bg-yellow-100">ADICIONAL</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300 bg-green-100">TOTAL<br>MERCANCÍA</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300 bg-red-100">VENDIDO</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300 bg-orange-100">PÉRDIDAS</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300 bg-green-200">STOCK</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300 bg-purple-100">PRECIO UNIT.</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 border border-gray-300">CATEGORÍA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalRecibido = 0;
                            $totalAdicional = 0;
                            $totalMercancia = 0;
                            $totalVendido = 0;
                            $totalPerdidas = 0;
                            $totalStock = 0;
                            
                            // Decidir qué datos usar: reporte guardado o datos actuales
                            $dataToShow = $isClosed && $savedReport->isNotEmpty() ? $savedReport : $products;
                        @endphp
                        
                        @forelse($dataToShow as $product)
                            @php
                                // Si es reporte guardado, usar los campos correspondientes
                                if ($isClosed && $savedReport->isNotEmpty()) {
                                    $received = $product->received ?? 0;
                                    $adicional = $product->additional_stock ?? 0;
                                    $sold = $product->sold ?? 0;
                                    $perdidas = $product->lost_stock ?? 0;
                                    $stock = $product->final_stock ?? 0;
                                    $price = $product->sale_price ?? 0;
                                    $productName = $product->product_name;
                                    $category = $product->category;
                                    $gender = $product->gender;
                                    $notes = $product->notes;
                                } else {
                                    // Datos actuales
                                    $received = $product->received ?? 0;
                                    $adicional = $product->additional_stock ?? 0;
                                    $sold = $product->sold ?? 0;
                                    $perdidas = $product->lost_stock ?? 0;
                                    $stock = $product->stock ?? 0;
                                    $price = $product->price ?? $product->unit_price ?? 0;
                                    $productName = $product->product_name;
                                    $category = $product->category;
                                    $gender = $product->gender;
                                    $notes = $product->notes;
                                }
                                $totalProducto = $received + $adicional;
                                
                                $totalRecibido += $received;
                                $totalAdicional += $adicional;
                                $totalMercancia += $totalProducto;
                                $totalVendido += $sold;
                                $totalPerdidas += $perdidas;
                                $totalStock += $stock;
                                
                                // Colores de fila según stock
                                $rowColor = '';
                                if($stock == 0) {
                                    $rowColor = 'bg-red-50';
                                } elseif($stock < 5) {
                                    $rowColor = 'bg-yellow-50';
                                } elseif($stock > 0) {
                                    $rowColor = 'bg-green-50';
                                }
                            @endphp
                            <tr class="{{ $rowColor }} hover:bg-gray-100">
                                <td class="px-4 py-2 border border-gray-300 font-medium text-gray-800">
                                    {{ $productName }}
                                    @if($notes)
                                        <span class="block text-xs text-gray-500 mt-1">
                                            <i class="fas fa-sticky-note"></i> {{ Str::limit($notes, 40) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center bg-pink-50">
                                    <span class="bg-pink-100 text-pink-800 px-2 py-1 rounded text-xs font-medium">
                                        {{ ucfirst($gender) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center bg-blue-50">
                                    {{ $received }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center bg-yellow-50 {{ $adicional > 0 ? 'font-semibold text-green-700' : '' }}">
                                    {{ $adicional }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center font-semibold bg-green-50">
                                    {{ $totalProducto }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center font-semibold bg-red-50">
                                    {{ $sold }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center bg-orange-50 {{ $perdidas > 0 ? 'font-semibold text-orange-700' : '' }}">
                                    {{ $perdidas }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center font-bold {{ $stock < 5 ? 'text-red-600 bg-red-50' : 'text-green-600 bg-green-100' }}">
                                    {{ $stock }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-right bg-purple-50">
                                    ${{ number_format($price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                                        {{ ucfirst($category) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                                    No hay productos registrados
                                </td>
                            </tr>
                        @endforelse
                        
                        <!-- FILA DE TOTALES -->
                        @if($dataToShow->count() > 0)
                            <tr class="bg-gray-800 text-white font-bold">
                                <td colspan="2" class="px-4 py-3 border border-gray-600">TOTALES</td>
                                <td class="px-4 py-3 border border-gray-600 text-center">{{ $totalRecibido }}</td>
                                <td class="px-4 py-3 border border-gray-600 text-center">{{ $totalAdicional }}</td>
                                <td class="px-4 py-3 border border-gray-600 text-center">{{ $totalMercancia }}</td>
                                <td class="px-4 py-3 border border-gray-600 text-center">{{ $totalVendido }}</td>
                                <td class="px-4 py-3 border border-gray-600 text-center">{{ $totalPerdidas }}</td>
                                <td class="px-4 py-3 border border-gray-600 text-center">{{ $totalStock }}</td>
                                <td class="px-4 py-3 border border-gray-600 text-right">-</td>
                                <td class="px-4 py-3 border border-gray-600"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Totales Financieros -->
        @php
            // Calcular totales financieros
            $totalVentasValor = 0;
            $totalStockValor = 0;
            $totalPerdidasValor = 0;
            $totalCostoCompra = 0;
            $totalCostoVendido = 0;
            
            foreach($dataToShow as $prod) {
                if ($isClosed && $savedReport->isNotEmpty()) {
                    $costPrice = $prod->cost_price ?? 0;
                    $salePrice = $prod->sale_price ?? 0;
                    $sold = $prod->sold ?? 0;
                    $stock = $prod->final_stock ?? 0;
                    $lost = $prod->lost_stock ?? 0;
                } else {
                    $costPrice = $prod->cost_price ?? 0;
                    $salePrice = $prod->price ?? $prod->unit_price ?? 0;
                    $sold = $prod->sold ?? 0;
                    $stock = $prod->stock ?? 0;
                    $lost = $prod->lost_stock ?? 0;
                }
                
                // Total vendido en precio de venta
                $totalVentasValor += $sold * $salePrice;
                
                // Total en stock en precio de venta
                $totalStockValor += $stock * $salePrice;
                
                // Total pérdidas en precio de venta
                $totalPerdidasValor += $lost * $salePrice;
                
                // Total costo de lo vendido (para calcular ganancia)
                $totalCostoVendido += $sold * $costPrice;
                
                // Total costo del stock actual
                $totalCostoCompra += $stock * $costPrice;
            }
            
            // Ganancia = (Precio Venta - Precio Costo) * Cantidad Vendida
            $gananciaTotal = $totalVentasValor - $totalCostoVendido;
        @endphp

        <div class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg shadow-md p-6 border-l-4 border-green-600">
            <h3 class="font-bold text-gray-800 mb-4 text-xl">
                <i class="fas fa-chart-line text-green-600 mr-2"></i>Resumen Financiero
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Vendido (Precio Venta) -->
                <div class="bg-white rounded-lg p-4 shadow">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-600">Total Vendido</span>
                        <i class="fas fa-shopping-cart text-red-500"></i>
                    </div>
                    <p class="text-2xl font-bold text-red-600">
                        ${{ number_format($totalVentasValor, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">{{ $dataToShow->sum('sold') }} unidades</p>
                </div>

                <!-- Total en Stock (Precio Venta) -->
                <div class="bg-white rounded-lg p-4 shadow">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-600">Valor en Stock</span>
                        <i class="fas fa-boxes text-blue-500"></i>
                    </div>
                    <p class="text-2xl font-bold text-blue-600">
                        ${{ number_format($totalStockValor, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">{{ $isClosed ? $dataToShow->sum('final_stock') : $dataToShow->sum('stock') }} unidades</p>
                </div>

                <!-- Total Pérdidas (Precio Venta) -->
                <div class="bg-white rounded-lg p-4 shadow">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-600">Pérdidas</span>
                        <i class="fas fa-exclamation-triangle text-orange-500"></i>
                    </div>
                    <p class="text-2xl font-bold text-orange-600">
                        ${{ number_format($totalPerdidasValor, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">{{ $dataToShow->sum('lost_stock') }} unidades</p>
                </div>

                <!-- Ganancia Total -->
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg p-4 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-green-100">Ganancia Neta</span>
                        <i class="fas fa-trophy text-yellow-300"></i>
                    </div>
                    <p class="text-2xl font-bold text-white">
                        ${{ number_format($gananciaTotal, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-green-100 mt-1">Precio venta - Precio compra</p>
                </div>
            </div>

            <!-- Detalle de costos -->
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                    <p class="text-xs text-blue-600 font-semibold mb-1">Costo de mercancía vendida</p>
                    <p class="text-lg font-bold text-blue-700">${{ number_format($totalCostoVendido, 0, ',', '.') }}</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-3 border border-purple-200">
                    <p class="text-xs text-purple-600 font-semibold mb-1">Costo de stock actual</p>
                    <p class="text-lg font-bold text-purple-700">${{ number_format($totalCostoCompra, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Leyenda -->
        <div class="mt-6 bg-white rounded-lg shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-3">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>Leyenda de Colores
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 bg-green-100 border border-green-300 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">Stock disponible</span>
                </div>
                <div class="flex items-center">
                    <div class="w-6 h-6 bg-yellow-100 border border-yellow-300 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">Stock bajo (&lt; 5 unidades)</span>
                </div>
                <div class="flex items-center">
                    <div class="w-6 h-6 bg-red-100 border border-red-300 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">Sin stock (agotado)</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print { display: none !important; }
    body { background: white; }
    table { page-break-inside: auto; }
    tr { page-break-inside: avoid; page-break-after: auto; }
}
</style>
@endsection

