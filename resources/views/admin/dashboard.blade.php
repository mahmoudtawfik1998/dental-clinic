@extends('layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2 class="mb-0">لوحة التحكم</h2>
        <p class="text-muted">مرحباً بك، <strong>{{ Auth::user()->name }}</strong></p>
    </div>
    <div class="col-md-4 text-end">
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">
                🚪 تسجيل الخروج
            </button>
        </form>
    </div>
</div>

<!-- رسائل النجاح -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>✅</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Statistics Cards -->
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">إجمالي الحجوزات</p>
                        <h3 class="mb-0">{{ $stats['total_appointments'] }}</h3>
                    </div>
                    <div class="icon">
                        <i class="icon-calendar" style="font-size: 40px; color: #3498db;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">قيد الانتظار</p>
                        <h3 class="mb-0">{{ $stats['pending_appointments'] }}</h3>
                    </div>
                    <div class="icon">
                        <i class="icon-clock" style="font-size: 40px; color: #f39c12;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">مؤكدة</p>
                        <h3 class="mb-0">{{ $stats['confirmed_appointments'] }}</h3>
                    </div>
                    <div class="icon">
                        <i class="icon-check" style="font-size: 40px; color: #27ae60;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">حجوزات اليوم</p>
                        <h3 class="mb-0">{{ $stats['today_appointments'] }}</h3>
                    </div>
                    <div class="icon">
                        <i class="icon-calendar" style="font-size: 40px; color: #9b59b6;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Appointments -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">آخر الحجوزات</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>رقم</th>
                                <th>المريض</th>
                                <th>الدكتور</th>
                                <th>الخدمة</th>
                                <th>التاريخ</th>
                                <th>الوقت</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAppointments as $appointment)
                            <tr>
                                <td>#{{ $appointment->id }}</td>
                                <td>
                                    <strong>{{ $appointment->patient->name }}</strong><br>
                                    <small class="text-muted">{{ $appointment->patient->phone }}</small>
                                </td>
                                <td>{{ $appointment->doctor->name }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $appointment->service->color }}20; color: {{ $appointment->service->color }};">
                                        {{ $appointment->service->name }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                <td>
                                    @if($appointment->status == 'pending')
                                        <span class="badge badge-warning">⏳ قيد الانتظار</span>
                                    @elseif($appointment->status == 'confirmed')
                                        <span class="badge badge-success">✅ مؤكد</span>
                                    @elseif($appointment->status == 'cancelled')
                                        <span class="badge badge-danger">❌ ملغي</span>
                                    @else
                                        <span class="badge badge-secondary">✓ مكتمل</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">لا توجد حجوزات بعد</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection