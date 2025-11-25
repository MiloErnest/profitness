<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Machine;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Obtener entrenadores activos
        $trainers = Trainer::where('active', true)
            ->orderBy('name')
            ->get();
        
        // Obtener máquinas activas
        $machines = Machine::where('active', true)
            ->orderBy('category')
            ->orderBy('name')
            ->get();
        
        return view('gym.index', compact('trainers', 'machines'));
    }
}
