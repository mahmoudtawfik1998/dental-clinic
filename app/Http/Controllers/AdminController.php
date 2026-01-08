<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;

class AdminController extends Controller
{
    // لوحة التحكم الرئيسية
    public function index()
    {
        // إحصائيات
        $stats = [
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'confirmed_appointments' => Appointment::where('status', 'confirmed')->count(),
            'today_appointments' => Appointment::whereDate('appointment_date', today())->count(),
            'total_patients' => Patient::count(),
            'total_doctors' => Doctor::count(),
        ];

        // آخر الحجوزات
        $recentAppointments = Appointment::with(['doctor', 'patient', 'service'])
                                        ->orderBy('created_at', 'desc')
                                        ->take(10)
                                        ->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments'));
    }

    // عرض كل الحجوزات
public function appointments(Request $request)
{
    $query = Appointment::with(['doctor', 'patient', 'service']);
    
    // فلترة حسب الحالة
    if ($request->has('status') && $request->status != 'all') {
        $query->where('status', $request->status);
    }
    
    $appointments = $query->orderBy('appointment_date', 'desc')
                        ->orderBy('appointment_time', 'desc')
                        ->paginate(20);

    return view('admin.appointments', compact('appointments'));
}

    // تأكيد الحجز
    public function confirmAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'confirmed']);

        return redirect()->back()->with('success', 'تم تأكيد الحجز بنجاح');
    }

    // إلغاء الحجز
    public function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'تم إلغاء الحجز');
    }

    // إدارة الدكاترة
    public function doctors()
    {
        $doctors = Doctor::withCount('appointments')->get();
        return view('admin.doctors', compact('doctors'));
    }

    // إدارة المرضى
    public function patients()
    {
        $patients = Patient::withCount('appointments')->paginate(20);
        return view('admin.patients', compact('patients'));
    }
}
