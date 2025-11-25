<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MachineController extends Controller
{
    // Vista administrativa (panel CRUD)
    public function adminIndex()
    {
        $machines = Machine::orderBy('created_at', 'desc')->get();
        return view('machines.admin', compact('machines'));
    }

    public function create()
    {
        return view('machines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean'
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        // Manejar imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('machines', 'public');
            $data['image'] = $imagePath;
        }

        Machine::create($data);

        return redirect()->route('machines.admin')->with('success', 'Máquina agregada exitosamente');
    }

    public function edit($id)
    {
        $machine = Machine::findOrFail($id);
        return view('machines.edit', compact('machine'));
    }

    public function update(Request $request, $id)
    {
        $machine = Machine::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean'
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        // Manejar imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($machine->image) {
                Storage::disk('public')->delete($machine->image);
            }
            $imagePath = $request->file('image')->store('machines', 'public');
            $data['image'] = $imagePath;
        } else {
            // Mantener la imagen existente si no se sube una nueva
            unset($data['image']);
        }

        $machine->update($data);

        return redirect()->route('machines.admin')->with('success', 'Máquina actualizada exitosamente');
    }

    public function destroy($id)
    {
        $machine = Machine::findOrFail($id);

        // Eliminar imagen si existe
        if ($machine->image) {
            Storage::disk('public')->delete($machine->image);
        }

        $machine->delete();

        return redirect()->route('machines.admin')->with('success', 'Máquina eliminada exitosamente');
    }
}
