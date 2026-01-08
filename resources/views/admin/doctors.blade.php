@extends('layouts.admin')

@section('title', 'إدارة الدكاترة')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">إدارة الدكاترة</h2>
        <p class="text-muted">عرض وإدارة جميع الدكاترة</p>
    </div>
    <div class="col-md-6 text-right">
        <a href="" class="btn btn-primary">
            <i class="icon-plus"></i> إضافة دكتور جديد
        </a>
    </div>
</div>

<!-- Doctors Grid -->
<div class="row">
    @forelse($doctors as $doctor)
    <div class="col-md-4 mb-4">
        <div class="card doctor-card h-100">
            <div class="card-body text-center">
                <!-- Doctor Image -->
                <div class="mb-3">
                    <img src="{{ $doctor->image ? asset($doctor->image) : asset('assets/images/person_5.jpg') }}" 
                        class="rounded-circle" 
                        width="120" 
                        height="120"
                        style="object-fit: cover; border: 4px solid #f8f9fa;"
                        onerror="this.src='{{ asset('assets/images/person_5.jpg') }}'">
                </div>
                
                <!-- Doctor Info -->
                <h5 class="mb-1">{{ $doctor->name }}</h5>
                <p class="text-muted mb-3">{{ $doctor->specialty }}</p>
                
                <!-- Phone -->
                @if($doctor->phone)
                <p class="mb-2">
                    <i class="icon-phone text-muted"></i>
                    <small>{{ $doctor->phone }}</small>
                </p>
                @endif
                
                <!-- Work Days -->
                @if($doctor->work_days)
                <div class="mb-3">
                    @foreach(array_slice($doctor->work_days, 0, 4) as $day)
                    <span class="badge badge-primary badge-sm">{{ $day }}</span>
                    @endforeach
                </div>
                @endif
                
                <!-- Work Hours -->
                @if($doctor->start_time && $doctor->end_time)
                <p class="mb-3 text-muted">
                    <i class="icon-clock"></i>
                    <small>{{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}</small>
                </p>
                @endif
                
                <!-- Appointments Count -->
                <div class="mb-3">
                    <span class="badge badge-info">{{ $doctor->appointments_count }} حجز</span>
                </div>
                
                <!-- Actions -->
                <div class="btn-group btn-group-sm w-100">
                    <a href="" class="btn btn-outline-primary">
                        <i class="icon-pencil"></i> تعديل
                    </a>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('هل أنت متأكد من حذف هذا الدكتور؟')">
                            <i class="icon-trash"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="icon-user" style="font-size: 64px; opacity: 0.3;"></i>
                <h5 class="mt-3 text-muted">لا يوجد دكاترة مسجلين</h5>
                <p class="text-muted">ابدأ بإضافة أول دكتور</p>
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary mt-3">
                    <i class="icon-plus"></i> إضافة دكتور جديد
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

<style>
    .doctor-card {
        transition: all 0.3s;
    }
    
    .doctor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
</style>
@endsection