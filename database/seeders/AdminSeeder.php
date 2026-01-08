<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@clinic.com',
            'password' => Hash::make('123456'), // غيّر الباسورد بعدين!
            'role' => 'admin'
        ]);
        
        $this->command->info('✅ تم إنشاء حساب الأدمن بنجاح!');
        $this->command->info('📧 Email: admin@clinic.com');
        $this->command->info('🔑 Password: 123456');
    }
}