<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'كشف',
                
                'price' => 200.00,
                'color' => '#10B981' // أخضر
            ],
            [
                'name' => 'حشو عادي',
                
                'price' => 500.00,
                'color' => '#3B82F6' // أزرق
            ],
            [
                'name' => 'حشو عصب',
                
                'price' => 1500.00,
                'color' => '#8B5CF6' // بنفسجي
            ],
            [
                'name' => 'خلع',
                
                'price' => 300.00,
                'color' => '#EF4444' // أحمر
            ],
            [
                'name' => 'تقويم',
                
                'price' => 2000.00,
                'color' => '#F59E0B' // برتقالي
            ],
            [
                'name' => 'متابعة',
                
                'price' => 150.00,
                'color' => '#6B7280' // رمادي
            ],
            [
                'name' => 'تنظيف وتلميع',
                
                'price' => 400.00,
                'color' => '#06B6D4' // سماوي
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}