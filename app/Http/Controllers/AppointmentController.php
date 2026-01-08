<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Patient;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{

        public function index()
    {
        $doctors = Doctor::all();
        $services = Service::all();

        return view('home', compact('doctors', 'services'));
    }
    // صفحة الحجز الرئيسية (للاستقبال)
    public function create()
    {
        // جلب كل الدكاترة والخدمات من قاعدة البيانات
        $doctors = Doctor::all();
        $services = Service::all();
        
        // إرسالهم للصفحة (View)
        return view('appointments.create', compact('doctors', 'services'));
    }

    // حفظ الحجز الجديد
    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة (Validation)
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'service_id' => 'required|exists:services,id',
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'patient_age' => 'nullable|integer',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'notes' => 'nullable|string'
        ]);

        // التحقق من توفر الموعد
        if (!Appointment::isTimeSlotAvailable($validated['doctor_id'], $validated['appointment_date'], $validated['appointment_time'])) {
            return back()->with('error', 'هذا الموعد محجوز بالفعل، برجاء اختيار موعد آخر');
        }

        // البحث عن المريض أو إنشاء مريض جديد
        $patient = Patient::firstOrCreate(
            ['phone' => $validated['patient_phone']], // البحث بالتليفون
            [
                'name' => $validated['patient_name'],
                'age' => $validated['patient_age'] ?? null
            ]
        );

        // إنشاء الحجز
        $appointment = Appointment::create([
            'doctor_id' => $validated['doctor_id'],
            'patient_id' => $patient->id,
            'service_id' => $validated['service_id'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => 'pending', // قيد الانتظار
            'notes' => $validated['notes']
        ]);

        return redirect()->back()->with('success', 'تم حجز الموعد بنجاح! رقم الحجز: ' . $appointment->id);
    }

    // جلب المواعيد المتاحة لدكتور معين في تاريخ معين
    public function getAvailableSlots(Request $request)
    {
        $doctorId = $request->doctor_id;
        $date = $request->date;

        // جلب بيانات الدكتور
        $doctor = Doctor::findOrFail($doctorId);

        // التحقق من أن التاريخ المختار من أيام عمل الدكتور
        $dayName = Carbon::parse($date)->locale('ar')->dayName;
        
        if (!in_array($dayName, $doctor->work_days ?? [])) {
            return response()->json([
                'available' => false,
                'message' => 'الدكتور لا يعمل في هذا اليوم'
            ]);
        }

        // توليد كل المواعيد الممكنة
        $startTime = Carbon::parse($doctor->start_time);
        $endTime = Carbon::parse($doctor->end_time);
        $slots = [];

        while ($startTime < $endTime) {
            $timeSlot = $startTime->format('H:i');
            
            // التحقق من توفر الموعد
            $isAvailable = Appointment::isTimeSlotAvailable($doctorId, $date, $timeSlot);
            
            $slots[] = [
                'time' => $timeSlot,
                'available' => $isAvailable
            ];

            $startTime->addMinutes(30); // كل 30 دقيقة
        }

        return response()->json([
            'available' => true,
            'slots' => $slots
        ]);
    }
}