<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'phone',
        'image',
        'work_days',
        'start_time',
        'end_time'

    ];

    protected $casts = [
        'work_days' =>'array'
    ];

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }


}

