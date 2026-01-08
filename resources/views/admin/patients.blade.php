@extends('layouts.admin')

@section('title', 'إدارة المرضى')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="mb-0">إدارة المرضى</h2>
        <p class="text-muted">عرض وإدارة جميع المرضى المسجلين</p>
    </div>
</div>

<!-- Patients Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>رقم</th>
                        <th>الاسم</th>
                        <th>التليفون</th>
                        <th>العمر</th>
                        <th>عدد الحجوزات</th>
                        <th>تاريخ التسجيل</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td class="align-middle">
                            <strong>#{{ $patient->id }}</strong>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-success text-white rounded-circle mr-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    {{ substr($patient->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $patient->name }}</strong>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <i class="icon-phone text-muted"></i>
                            {{ $patient->phone }}
                        </td>
                        <td class="align-middle">
                            {{ $patient->age ? $patient->age . ' سنة' : '-' }}
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-primary badge-pill">
                                {{ $patient->appointments_count }}
                            </span>
                        </td>
                        <td class="align-middle text-muted">
                            <i class="icon-calendar"></i>
                            {{ $patient->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="icon-users" style="font-size: 48px; opacity: 0.3;"></i>
                            <p class="mt-3 mb-0">لا يوجد مرضى مسجلين</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($patients->hasPages())
    <div class="card-footer bg-white">
        {{ $patients->links() }}
    </div>
    @endif
</div>
@endsection