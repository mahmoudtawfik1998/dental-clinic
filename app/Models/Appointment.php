<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',

    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

            // دالة للتحقق من توفر الموعد

    
    public static function isTimeSlotAvailable($doctorId,$date,$time,$excludeId = null)
    {
        $query= self::where('doctor_id', $doctorId)->where('appointment_date', $date)->where('appointment_time', $time)
        ->where('status', '!=', 'cancelled');

                // لو بنعدل حجز موجود، نستثنيه من البحث
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        return !$query->exists();


    }




}
