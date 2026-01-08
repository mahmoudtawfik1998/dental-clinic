<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Routes تسجيل الدخول والخروج
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Routes العامة (بدون حماية)
|--------------------------------------------------------------------------
*/
Route::get('/', [AppointmentController::class, 'index'])->name('home');

// صفحة إنشاء حجز جديد
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

// API: جلب المواعيد المتاحة (AJAX)
Route::post('/appointments/available-slots', [AppointmentController::class, 'getAvailableSlots'])->name('appointments.available-slots');

/*
|--------------------------------------------------------------------------
| Routes لوحة تحكم الأدمن (محمية بـ Middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    
    // لوحة التحكم الرئيسية
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // إدارة الحجوزات
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
    Route::post('/appointments/{id}/confirm', [AdminController::class, 'confirmAppointment'])->name('appointments.confirm');
    Route::post('/appointments/{id}/cancel', [AdminController::class, 'cancelAppointment'])->name('appointments.cancel');
    
    // إدارة الدكاترة
    Route::get('/doctors', [AdminController::class, 'doctors'])->name('doctors');
    
    // إدارة المرضى
    Route::get('/patients', [AdminController::class, 'patients'])->name('patients');
});