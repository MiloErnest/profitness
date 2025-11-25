<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Mostrar el formulario de contacto
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Procesar el formulario de contacto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'Debe ser un email válido',
            'subject.required' => 'El asunto es obligatorio',
            'message.required' => 'El mensaje es obligatorio',
        ]);

        try {
            // Guardar en base de datos
            Contact::create($validated);

            // Redireccionar con mensaje de éxito
            return redirect()->route('contact')->with('success', 'Gracias por contactarnos. Te responderemos pronto.');
        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', 'Hubo un error al enviar tu mensaje. Por favor, intenta nuevamente.');
        }
    }

    /**
     * Mostrar todos los mensajes (Admin)
     */
    public function adminIndex()
    {
        $messages = Contact::orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = Contact::where('status', 'pending')->count();
        
        return view('admin.contacts.index', compact('messages', 'unreadCount'));
    }

    /**
     * Marcar mensaje como leído
     */
    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'read']);
        
        return redirect()->back()->with('success', 'Mensaje marcado como leído');
    }

    /**
     * Eliminar mensaje
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return redirect()->back()->with('success', 'Mensaje eliminado correctamente');
    }
}
