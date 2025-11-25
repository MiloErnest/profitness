<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function adminIndex()
    {
        $members = Member::with('membershipPlan')->orderBy('created_at', 'desc')->get();

        return view('members.admin', compact('members'));
    }

    public function create()
    {
        $plans = MembershipPlan::where('is_active', true)->orderBy('price')->get();

        return view('members.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'start_date' => 'required|date',
        ]);

        $plan = MembershipPlan::findOrFail($request->membership_plan_id);
        $startDate = Carbon::parse($request->start_date);
        $endDate = $startDate->copy()->addDays($plan->duration_days);

        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'membership_plan_id' => $plan->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        // Si el miembro tiene correo, crear automáticamente una cuenta de usuario
        if ($request->email) {
            // Verificar si ya existe un usuario con este correo
            $existingUser = User::where('email', $request->email)->first();
            
            if (!$existingUser) {
                // Crear nuevo usuario
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make('123456789'),
                    'role' => 'user',
                    'member_id' => $member->id,
                ]);
            } else {
                // Si el usuario ya existe, actualizar sus datos y limpiar asistencias antiguas
                $existingUser->update([
                    'name' => $request->name,
                    'member_id' => $member->id,
                    'password' => Hash::make('123456789'), // Resetear contraseña
                ]);
                // Eliminar asistencias antiguas para empezar de cero
                $existingUser->attendances()->delete();
            }
        }

        return redirect()->route('members.admin')->with('success', 'Miembro registrado correctamente.' . ($request->email ? ' Se ha creado una cuenta de usuario con contraseña: 123456789' : ''));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $plans = MembershipPlan::where('is_active', true)->orderBy('price')->get();

        return view('members.edit', compact('member', 'plans'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'start_date' => 'required|date',
        ]);

        $plan = MembershipPlan::findOrFail($request->membership_plan_id);
        $startDate = Carbon::parse($request->start_date);
        $endDate = $startDate->copy()->addDays($plan->duration_days);

        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'membership_plan_id' => $plan->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        return redirect()->route('members.admin')->with('success', 'Miembro actualizado correctamente.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        
        // Buscar y eliminar el usuario asociado si existe
        $user = User::where('member_id', $member->id)->first();
        
        if ($user) {
            // Eliminar primero las asistencias del usuario
            $user->attendances()->delete();
            // Eliminar el usuario
            $user->delete();
        }
        
        // Finalmente eliminar el miembro
        $member->delete();

        return redirect()->route('members.admin')->with('success', 'Miembro y cuenta de usuario eliminados correctamente.');
    }

    public function plans()
    {
        $plans = MembershipPlan::where('is_active', true)->orderBy('price')->get();

        return view('members.plans', compact('plans'));
    }
}
