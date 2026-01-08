@extends('layouts.admin')

@section('title', 'إدارة الحجوزات')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">إدارة الحجوزات</h2>
        <p class="text-muted">عرض وإدارة جميع الحجوزات</p>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
            <i class="icon-plus"></i> حجز جديد
        </a>
    </div>
</div>

<!-- Filter Tabs -->
<div class="card mb-4">
    <div class="card-body">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <a href="?status=all" class="btn {{ request('status', 'all') == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                الكل
            </a>
            <a href="?status=pending" class="btn {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">
                قيد الانتظار
            </a>
            <a href="?status=confirmed" class="btn {{ request('status') == 'confirmed' ? 'btn-success' : 'btn-outline-success' }}">
                مؤكدة
            </a>
            <a href="?status=cancelled" class="btn {{ request('status') == 'cancelled' ? 'btn-danger' : 'btn-outline-danger' }}">
                ملغاة
            </a>
            <a href="?status=completed" class="btn {{ request('status') == 'completed' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                مكتملة
            </a>
        </div>
    </div>
</div>

<!-- Appointments Table -->
<div class="card">
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
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr>
                        <td class="align-middle">
                            <strong>#{{ $appointment->id }}</strong>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-primary text-white rounded-circle mr-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    {{ substr($appointment->patient->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $appointment->patient->name }}</strong><br>
                                    <small class="text-muted">{{ $appointment->patient->phone }}</small>
                                    @if($appointment->patient->age)
                                    <br><small class="text-muted">{{ $appointment->patient->age }} سنة</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <strong>{{ $appointment->doctor->name }}</strong><br>
                            <small class="text-muted">{{ $appointment->doctor->specialty }}</small>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-pill" style="background-color: {{ $appointment->service->color }}20; color: {{ $appointment->service->color }}; font-size: 12px;">
                                {{ $appointment->service->name }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <i class="icon-calendar text-muted"></i>
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}
                        </td>
                        <td class="align-middle">
                            <i class="icon-clock text-muted"></i>
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </td>
                        <td class="align-middle">
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
                        <td class="align-middle">
                            @if($appointment->status == 'pending')
                            <div class="btn-group btn-group-sm">
                                <form action="{{ route('admin.appointments.confirm', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" title="تأكيد">
                                        <i class="icon-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.appointments.cancel', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من إلغاء هذا الحجز؟')" title="إلغاء">
                                        <i class="icon-close"></i>
                                    </button>
                                </form>
                            </div>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="icon-calendar" style="font-size: 48px; opacity: 0.3;"></i>
                            <p class="mt-3 mb-0">لا توجد حجوزات</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($appointments->hasPages())
    <div class="card-footer bg-white">
        {{ $appointments->links() }}
    </div>
    @endif
</div>
@endsection