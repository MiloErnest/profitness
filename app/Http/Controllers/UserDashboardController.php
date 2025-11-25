<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    /**
     * Display user dashboard
     */
    public function index()
    {
        $user = auth()->user();
        $member = $user->member()->with('membershipPlan')->first();

        // Get attendance statistics
        $totalAttendances = $user->attendances()->count();
        $currentMonthAttendances = $user->attendances()
            ->whereMonth('attendance_date', Carbon::now()->month)
            ->whereYear('attendance_date', Carbon::now()->year)
            ->count();

        // Get recent attendances
        $recentAttendances = $user->attendances()
            ->orderBy('attendance_date', 'desc')
            ->take(10)
            ->get();

        // Calculate membership remaining days
        $remainingDays = null;
        if ($member && $member->end_date) {
            $endDate = Carbon::parse($member->end_date);
            $now = Carbon::now();
            
            if ($endDate->isPast()) {
                $remainingDays = 0;
            } else {
                // Calcular días restantes como número entero
                $remainingDays = (int) $now->diffInDays($endDate, false);
            }
        }

        // Check if already marked attendance today
        $todayAttendance = $user->attendances()
            ->whereDate('attendance_date', Carbon::today())
            ->first();

        return view('user.dashboard', compact(
            'user',
            'member',
            'totalAttendances',
            'currentMonthAttendances',
            'recentAttendances',
            'remainingDays',
            'todayAttendance'
        ));
    }

    /**
     * Mark attendance for today
     */
    public function markAttendance(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Verificar que el usuario tenga una membresía activa antes de registrar asistencia
        $member = $user->member;

        if (! $member || ! $member->is_active) {
            return redirect()->route('user.dashboard')
                ->with('info', 'Tu membresía no está activa o ha vencido. No puedes registrar asistencia. Por favor renueva tu plan.');
        }

        // Check if already marked today
        $existingAttendance = $user->attendances()
            ->whereDate('attendance_date', $today)
            ->first();

        if ($existingAttendance) {
            return redirect()->route('user.dashboard')
                ->with('info', '¡Ya registraste tu asistencia hoy!');
        }

        // Create new attendance
        Attendance::create([
            'user_id' => $user->id,
            'attendance_date' => $today,
            'check_in_time' => Carbon::now(),
            'notes' => $request->input('notes'),
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', '¡Excelente! Asistencia registrada. ¡Sigue así! 💪');
    }
}
