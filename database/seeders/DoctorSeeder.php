<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{

    public function run(): void
    {
                $doctors = [
            [
                'name' => 'د. أحمد مصطفى وزيري',
                'specialty' => 'جراحة الفم والأسنان',
                'phone' => '01555801313',
                'work_days' => ['السبت', 'الأحد', 'الاثنين', 'الثلاثاء'],
                'start_time' => '09:00',
                'end_time' => '17:00'
            ],
            [
                'name' => 'د. سارة علي',
                'specialty' => 'تقويم الأسنان',
                'phone' => '01098765432',
                'work_days' => ['الأحد', 'الاثنين', 'الأربعاء'],
                'start_time' => '14:00',
                'end_time' => '21:00'
            ],
            [
                'name' => 'د.احمد اسماعيل',
                'specialty' => 'علاج الجذور والحشو',
                'phone' => '01093944373',
                'work_days' => ['السبت', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس'],
                'start_time' => '10:00',
                'end_time' => '18:00'
            ],
        ];
        foreach ($doctors as $doctor){
            Doctor::create($doctor);
        }


    }
}
