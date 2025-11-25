<?php

namespace App\Http\Controllers;

use App\Models\CafeteriaSale;
use App\Models\Supplement;
use App\Models\SportClothes;
use App\Models\Trainer;
use App\Models\Inventory;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalCafeteriaProducts' => CafeteriaSale::count(),
            'totalSupplements' => Supplement::count(),
            'totalSportsClothes' => SportClothes::count(),
            'totalTrainers' => Trainer::count(),
            
            // Nuevas estadísticas del inventario
            'totalInventoryValue' => Inventory::sum('total_value'),
            'lowStockItems' => Inventory::lowStock()->count(),
            'outOfStockItems' => Inventory::outOfStock()->count(),
            'totalProductsInInventory' => Inventory::count(),
            
            // Mensajes de contacto
            'totalContactMessages' => Contact::count(),
            'unreadContactMessages' => Contact::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', $stats);
    }
}