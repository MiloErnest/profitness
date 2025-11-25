<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    // Vista administrativa (panel CRUD)
    public function adminIndex()
    {
        $trainers = Trainer::orderBy('created_at', 'desc')->get();
        return view('trainers.admin', compact('trainers'));
    }

    public function create()
    {
        return view('trainers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'description' => 'nullable|string',
            'experience' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean'
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        // Manejar imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trainers', 'public');
            $data['image'] = $imagePath;
        }

        Trainer::create($data);

        return redirect()->route('trainers.admin')->with('success', 'Entrenador agregado exitosamente');
    }

    public function edit($id)
    {
        $trainer = Trainer::findOrFail($id);
        return view('trainers.edit', compact('trainer'));
    }

    public function update(Request $request, $id)
    {
        $trainer = Trainer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'description' => 'nullable|string',
            'experience' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean'
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        // Manejar imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($trainer->image) {
                Storage::disk('public')->delete($trainer->image);
            }
            $imagePath = $request->file('image')->store('trainers', 'public');
            $data['image'] = $imagePath;
        } else {
            // Mantener la imagen existente si no se sube una nueva
            unset($data['image']);
        }

        $trainer->update($data);

        return redirect()->route('trainers.admin')->with('success', 'Entrenador actualizado exitosamente');
    }

    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);

        // Eliminar imagen si existe
        if ($trainer->image) {
            Storage::disk('public')->delete($trainer->image);
        }

        $trainer->delete();

        return redirect()->route('trainers.admin')->with('success', 'Entrenador eliminado exitosamente');
    }
}
