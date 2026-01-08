@extends('layouts.app')

@section('title', 'حجز موعد جديد')

@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center heading-section ftco-animate">
                <h2 class="mb-3">احجز موعدك الآن</h2>
                <p>املأ النموذج التالي وسنتواصل معك لتأكيد الموعد</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="wrapper">
                    <div class="contact-wrap w-100 p-md-5 p-4">
                        {{-- رسائل النجاح أو الخطأ --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('appointments.store') }}" method="POST" id="appointmentForm">
                            @csrf

                            {{-- اختيار الدكتور --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">اختر الدكتور *</label>
                                <select name="doctor_id" class="form-control" required onchange="updateAvailableSlots()">
                                    <option value="">-- اختر الدكتور --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->specialty }})</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- اختيار الخدمة --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">اختر الخدمة *</label>
                                <select name="service_id" class="form-control" required>
                                    <option value="">-- اختر الخدمة --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }} @if($service->price) - {{ $service->price }} جنيه @endif</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- بيانات المريض --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="font-weight-bold">اسم المريض *</label>
                                    <input type="text" name="patient_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold">رقم الهاتف *</label>
                                    <input type="tel" name="patient_phone" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">العمر (اختياري)</label>
                                <input type="number" name="patient_age" class="form-control" min="1" max="120">
                            </div>

                            {{-- التاريخ والوقت --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="font-weight-bold">التاريخ *</label>
                                    <input type="date" name="appointment_date" id="appointment_date" class="form-control" min="{{ date('Y-m-d') }}" required onchange="updateAvailableSlots()">
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold">الوقت *</label>
                                    <select name="appointment_time" id="appointment_time" class="form-control" required>
                                        <option value="">اختر الدكتور والتاريخ أولاً</option>
                                    </select>
                                    <small id="loading-slots" class="text-info d-none">جاري تحميل المواعيد...</small>
                                </div>
                            </div>

                            {{-- ملاحظات --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">ملاحظات (اختياري)</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="أي ملاحظات إضافية..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block py-3">احجز الموعد</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
function updateAvailableSlots() {
    const doctorId = document.querySelector('select[name="doctor_id"]').value;
    const date = document.getElementById('appointment_date').value;
    const timeSelect = document.getElementById('appointment_time');
    const loadingDiv = document.getElementById('loading-slots');

    if (!doctorId || !date) {
        timeSelect.innerHTML = '<option value="">اختر الدكتور والتاريخ أولاً</option>';
        return;
    }

    loadingDiv.classList.remove('d-none');
    timeSelect.disabled = true;

    fetch('{{ route("appointments.available-slots") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ doctor_id: doctorId, date: date })
    })
    .then(response => response.json())
    .then(data => {
        loadingDiv.classList.add('d-none');
        timeSelect.disabled = false;

        if (!data.available) {
            timeSelect.innerHTML = '<option value="">الدكتور لا يعمل في هذا اليوم</option>';
            return;
        }

        timeSelect.innerHTML = '<option value="">اختر الوقت</option>';
        data.slots.forEach(slot => {
            const option = document.createElement('option');
            option.value = slot.time;
            option.textContent = slot.time + (slot.available ? ' ✓ متاح' : ' ❌ محجوز');
            option.disabled = !slot.available;
            timeSelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
        loadingDiv.classList.add('d-none');
        timeSelect.disabled = false;
        alert('حدث خطأ في تحميل المواعيد');
    });
}
</script>
@endsection
