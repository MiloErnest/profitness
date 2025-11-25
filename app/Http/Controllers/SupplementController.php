<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use App\Models\SupplementMonthlyReport;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplementController extends Controller
{
    // Vista pública (para clientes)
    public function index()
    {
        $supplements = Supplement::orderBy('category')->orderBy('name')->get();
        return view('supplements.index', compact('supplements'));
    }

    // Vista administrativa (panel CRUD)
    public function adminIndex()
    {
        $supplements = Supplement::orderBy('created_at', 'desc')->get();
        return view('supplements.admin', compact('supplements'));
    }

    public function create()
    {
        $categories = ['Proteínas', 'Creatinas', 'Pre-Entrenos', 'Aminoácidos', 'Vitaminas', 'Otros'];
        return view('supplements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'received' => 'required|integer|min:0',
            'additional_stock' => 'nullable|integer|min:0',
            'sold' => 'required|integer|min:0',
            'lost_stock' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Asegurar valores por defecto
        $data['additional_stock'] = $request->additional_stock ?? 0;
        $data['lost_stock'] = $request->lost_stock ?? 0;

        // Calcular stock: (Recibido + Adicional) - (Vendido + Pérdidas)
        $totalMercancia = $request->received + $data['additional_stock'];
        $totalSalidas = $request->sold + $data['lost_stock'];
        $data['stock'] = $totalMercancia - $totalSalidas;
        
        // Usar el precio como unit_price para mantener compatibilidad con la base de datos
        $data['unit_price'] = $request->price;
        
        // Calcular valor total del inventario (solo del stock disponible)
        $data['total_value'] = $data['stock'] * $request->price;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('supplements', 'public');
        }

        $supplement = Supplement::create($data);

        // ACTUALIZAR INVENTARIO
        $inventory = Inventory::updateOrCreate(
            [
                'product_type' => 'supplement',
                'product_id' => $supplement->id
            ],
            [
                'product_name' => $supplement->name,
                'initial_stock' => $totalMercancia,
                'current_stock' => $data['stock'],
                'sold_quantity' => $totalSalidas,
                'cost_price' => $request->cost_price,
                'sale_price' => $request->price,
                'total_value' => $data['total_value'],
                'last_restock_date' => now(),
                'notes' => $request->notes ?? 'Creado desde panel de suplementos'
            ]
        );

        return redirect()->route('supplements.admin')->with('success', 'Suplemento agregado exitosamente');
    }

    public function edit($id)
    {
        $supplement = Supplement::findOrFail($id);
        $categories = ['Proteínas', 'Creatinas', 'Pre-Entrenos', 'Aminoácidos', 'Vitaminas', 'Otros'];
        return view('supplements.edit', compact('supplement', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'received' => 'required|integer|min:0',
            'additional_stock' => 'nullable|integer|min:0',
            'sold' => 'required|integer|min:0',
            'lost_stock' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $supplement = Supplement::findOrFail($id);
        $data = $request->all();

        // Asegurar valores por defecto
        $data['additional_stock'] = $request->additional_stock ?? 0;
        $data['lost_stock'] = $request->lost_stock ?? 0;

        // Calcular stock: (Recibido + Adicional) - (Vendido + Pérdidas)
        $totalMercancia = $request->received + $data['additional_stock'];
        $totalSalidas = $request->sold + $data['lost_stock'];
        $data['stock'] = $totalMercancia - $totalSalidas;
        
        // Usar el precio como unit_price para mantener compatibilidad
        $data['unit_price'] = $request->price;
        
        // Calcular valor total del inventario (solo del stock disponible)
        $data['total_value'] = $data['stock'] * $request->price;

        if ($request->hasFile('image')) {
            if ($supplement->image) {
                Storage::disk('public')->delete($supplement->image);
            }
            $data['image'] = $request->file('image')->store('supplements', 'public');
        }

        $supplement->update($data);

        // ACTUALIZAR INVENTARIO
        $inventory = Inventory::updateOrCreate(
            [
                'product_type' => 'supplement',
                'product_id' => $supplement->id
            ],
            [
                'product_name' => $supplement->name,
                'initial_stock' => $totalMercancia,
                'current_stock' => $data['stock'],
                'sold_quantity' => $totalSalidas,
                'cost_price' => $request->cost_price,
                'sale_price' => $request->price,
                'total_value' => $data['total_value'],
                'last_restock_date' => now(),
                'notes' => $request->notes ?? 'Actualizado desde panel de suplementos'
            ]
        );

        return redirect()->route('supplements.admin')->with('success', 'Suplemento actualizado exitosamente');
    }

    public function destroy($id)
    {
        $supplement = Supplement::findOrFail($id);
        
        if ($supplement->image) {
            Storage::disk('public')->delete($supplement->image);
        }

        // Eliminar también del inventario
        Inventory::where('product_type', 'supplement')
                 ->where('product_id', $supplement->id)
                 ->delete();

        $supplement->delete();

        return redirect()->route('supplements.admin')->with('success', 'Suplemento eliminado exitosamente');
    }

    // Reporte detallado
    public function report(Request $request)
    {
        // Si hay parámetros en la URL, usarlos y guardar en sesión
        if ($request->has('year') || $request->has('month')) {
            $currentYear = (int) $request->input('year', now()->year);
            $currentMonth = (int) $request->input('month', now()->month);
            
            // Guardar en sesión para recordar
            session(['supplements_last_year' => $currentYear]);
            session(['supplements_last_month' => $currentMonth]);
        } else {
            // Si no hay parámetros, usar los de la sesión o el mes actual como fallback
            $currentYear = (int) session('supplements_last_year', now()->year);
            $currentMonth = (int) session('supplements_last_month', now()->month);
        }
        
        // Obtener todos los productos actuales
        $products = Supplement::orderBy('name')->get();
        
        // Verificar si existe un reporte guardado para este mes
        $savedReport = SupplementMonthlyReport::where('year', $currentYear)
                                            ->where('month', $currentMonth)
                                            ->get();
        
        // Si existe reporte guardado y está cerrado, mostrar el reporte guardado
        $isClosed = $savedReport->isNotEmpty() && $savedReport->first()->is_closed;
        
        // Obtener lista de meses disponibles (con reportes guardados)
        $availableMonths = SupplementMonthlyReport::selectRaw('DISTINCT year, month')
                                                ->orderBy('year', 'desc')
                                                ->orderBy('month', 'desc')
                                                ->get()
                                                ->map(function($item) {
                                                    return [
                                                        'year' => $item->year,
                                                        'month' => $item->month,
                                                        'label' => $this->getMonthName($item->month) . ' ' . $item->year
                                                    ];
                                                })
                                                ->unique(function($item) {
                                                    return $item['year'] . '-' . $item['month'];
                                                })
                                                ->values();
        
        // Agrupar meses por año para mejor organización
        $monthsByYear = $availableMonths->groupBy('year');
        
        // Obtener nombre del mes
        $monthName = $this->getMonthName($currentMonth);
        
        return view('supplements.report', compact(
            'products', 
            'savedReport', 
            'currentYear', 
            'currentMonth', 
            'monthName',
            'isClosed',
            'availableMonths',
            'monthsByYear'
        ));
    }
    
    // Método para ir al mes actual
    public function goToCurrentMonth()
    {
        // Limpiar sesión y forzar mes actual
        session()->forget(['supplements_last_year', 'supplements_last_month']);
        
        return redirect()->route('supplements.report', [
            'year' => now()->year,
            'month' => now()->month
        ]);
    }
    
    // Método para actualizar mes (agregar nuevos productos o reabrir)
    public function updateMonth(Request $request)
    {
        $year = (int) $request->input('year', now()->year);
        $month = (int) $request->input('month', now()->month);
        
        // Obtener todos los productos actuales
        $products = Supplement::all();
        
        // Obtener IDs de productos que ya están en el reporte
        $existingReportProductIds = SupplementMonthlyReport::where('year', $year)
                                                          ->where('month', $month)
                                                          ->pluck('supplement_id')
                                                          ->toArray();
        
        // Encontrar productos nuevos que no están en el reporte
        $newProducts = $products->whereNotIn('id', $existingReportProductIds);
        
        $newProductsCount = 0;
        
        // Agregar solo los productos nuevos al reporte
        foreach ($newProducts as $product) {
            $received = $product->received ?? 0;
            $additional = $product->additional_stock ?? 0;
            $sold = $product->sold ?? 0;
            $lost = $product->lost_stock ?? 0;
            $stock = $product->stock ?? 0;
            $costPrice = $product->cost_price ?? 0;
            $salePrice = $product->price ?? 0;
            
            // Calcular valores
            $totalSalesValue = $sold * $salePrice;
            $totalCostValue = $sold * $costPrice;
            $profit = $totalSalesValue - $totalCostValue;
            $stockValue = $stock * $salePrice;
            $lossesValue = $lost * $salePrice;
            
            SupplementMonthlyReport::create([
                'year' => $year,
                'month' => $month,
                'supplement_id' => $product->id,
                'product_name' => $product->name,
                'category' => $product->category,
                'received' => $received,
                'additional_stock' => $additional,
                'sold' => $sold,
                'lost_stock' => $lost,
                'final_stock' => $stock,
                'cost_price' => $costPrice,
                'sale_price' => $salePrice,
                'total_sales_value' => $totalSalesValue,
                'total_cost_value' => $totalCostValue,
                'profit' => $profit,
                'stock_value' => $stockValue,
                'losses_value' => $lossesValue,
                'is_closed' => true,
                'notes' => $product->notes
            ]);
            
            $newProductsCount++;
        }
        
        // Actualizar sesión
        session(['supplements_last_year' => $year]);
        session(['supplements_last_month' => $month]);
        
        if ($newProductsCount > 0) {
            return redirect()->route('supplements.report', ['year' => $year, 'month' => $month])
                           ->with('success', "Se agregaron {$newProductsCount} producto(s) nuevo(s) al reporte del mes.");
        } else {
            return redirect()->route('supplements.report', ['year' => $year, 'month' => $month])
                           ->with('info', 'No hay productos nuevos para agregar al reporte.');
        }
    }
    
    // Método para cerrar el mes actual
    public function closeMonth(Request $request)
    {
        $year = (int) $request->input('year', now()->year);
        $month = (int) $request->input('month', now()->month);
        
        // Verificar si ya existe un cierre para este mes
        $existingReport = SupplementMonthlyReport::where('year', $year)
                                               ->where('month', $month)
                                               ->first();
        
        if ($existingReport && $existingReport->is_closed) {
            return redirect()->route('supplements.report', ['year' => $year, 'month' => $month])
                           ->with('error', 'Este mes ya está cerrado');
        }
        
        // Eliminar reportes anteriores del mismo mes si existen
        SupplementMonthlyReport::where('year', $year)->where('month', $month)->delete();
        
        // Obtener todos los productos actuales
        $products = Supplement::all();
        
        // Crear un snapshot de cada producto para este mes
        foreach ($products as $product) {
            $received = $product->received ?? 0;
            $additional = $product->additional_stock ?? 0;
            $sold = $product->sold ?? 0;
            $lost = $product->lost_stock ?? 0;
            $stock = $product->stock ?? 0;
            $costPrice = $product->cost_price ?? 0;
            $salePrice = $product->price ?? 0;
            
            // Calcular valores
            $totalSalesValue = $sold * $salePrice;
            $totalCostValue = $sold * $costPrice;
            $profit = $totalSalesValue - $totalCostValue;
            $stockValue = $stock * $salePrice;
            $lossesValue = $lost * $salePrice;
            
            SupplementMonthlyReport::create([
                'year' => $year,
                'month' => $month,
                'supplement_id' => $product->id,
                'product_name' => $product->name,
                'category' => $product->category,
                'received' => $received,
                'additional_stock' => $additional,
                'sold' => $sold,
                'lost_stock' => $lost,
                'final_stock' => $stock,
                'cost_price' => $costPrice,
                'sale_price' => $salePrice,
                'total_sales_value' => $totalSalesValue,
                'total_cost_value' => $totalCostValue,
                'profit' => $profit,
                'stock_value' => $stockValue,
                'losses_value' => $lossesValue,
                'is_closed' => true,
                'notes' => $product->notes
            ]);
        }
        
        // Actualizar sesión
        session(['supplements_last_year' => $year]);
        session(['supplements_last_month' => $month]);
        
        return redirect()->route('supplements.report', ['year' => $year, 'month' => $month])
                       ->with('success', 'Mes cerrado exitosamente. El reporte ha sido guardado.');
    }
    
    // Método para eliminar un mes guardado
    public function deleteMonth(Request $request)
    {
        $year = (int) $request->input('year');
        $month = (int) $request->input('month');
        
        // Eliminar todos los reportes de ese mes
        $deleted = SupplementMonthlyReport::where('year', $year)
                                        ->where('month', $month)
                                        ->delete();
        
        if ($deleted > 0) {
            return redirect()->route('supplements.report')
                           ->with('success', 'El reporte de ' . $this->getMonthName($month) . ' ' . $year . ' ha sido eliminado exitosamente.');
        } else {
            return redirect()->route('supplements.report')
                           ->with('error', 'No se pudo eliminar el reporte.');
        }
    }
    
    // Helper para obtener nombre del mes
    private function getMonthName($month)
    {
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        return $months[$month] ?? '';
    }
}