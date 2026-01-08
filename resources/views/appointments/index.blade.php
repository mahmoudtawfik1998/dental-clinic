@extends('home')

@section('title', 'الخدمات - عيادة الأسنان')

@section('content')

<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">خدماتنا</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">الرئيسية <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>الخدمات <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <h2 class="mb-3">خدماتنا المتميزة</h2>
                <p>نقدم مجموعة شاملة من خدمات طب الأسنان بأعلى جودة وأحدث التقنيات</p>
            </div>
        </div>

        <div class="row">
            @forelse($services as $service)
            <div class="col-md-4 mb-4 ftco-animate">
                <div class="service-card h-100">
                    <div class="block-7">
                        <div class="img" style="background-image: url({{ asset('assets/images/service-bg.jpg') }}); background-color: {{ $service->color }}20;">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span style="font-size: 60px;">
                                    @if($service->name == 'كشف') 🔍
                                    @elseif($service->name == 'حشو عادي') 🦷
                                    @elseif($service->name == 'حشو عصب') 💉
                                    @elseif($service->name == 'خلع') 🔧
                                    @elseif($service->name == 'تقويم') 😁
                                    @elseif($service->name == 'متابعة') 📋
                                    @elseif($service->name == 'تنظيف وتلميع') ✨
                                    @else 🦷
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="text p-4">
                            <h3 class="heading mb-3">{{ $service->name }}</h3>
                            
                            <!-- المدة -->
                            <p class="mb-2">
                                <i class="icon-clock text-primary"></i>
                                <strong>المدة:</strong> {{ $service->duration }} دقيقة
                            </p>
                            
                            <!-- السعر -->
                            @if($service->price)
                            <p class="mb-3">
                                <i class="icon-money text-success"></i>
                                <strong>السعر:</strong> {{ $service->price }} جنيه
                            </p>
                            @endif
                            
                            <!-- الوصف (لو موجود) -->
                            <p class="text-muted">
                                {{ Str::limit('خدمة متميزة باستخدام أحدث التقنيات والأجهزة الطبية', 80) }}
                            </p>
                            
                            <!-- زر المزيد -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary btn-sm">
                                    المزيد من التفاصيل
                                </a>
                                @auth
                                <a href="{{ route('appointments.create') }}" class="btn btn-outline-primary btn-sm">
                                    احجز الآن
                                </a>
                                @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                                    احجز الآن
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 text-center py-5">
                <p class="text-muted">لا توجد خدمات متاحة حالياً</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="ftco-section ftco-no-pt ftco-no-pb" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-8 text-center">
                <h2 class="mb-4">هل تحتاج إلى استشارة؟</h2>
                <p class="mb-4">فريقنا الطبي المتخصص جاهز لمساعدتك في اختيار الخدمة المناسبة</p>
                @auth
                <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-lg px-5 py-3">
                    احجز استشارة مجانية
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3">
                    احجز استشارة مجانية
                </a>
                @endauth
            </div>
        </div>
    </div>
</section>

<style>
.service-card {
    transition: transform 0.3s, box-shadow 0.3s;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.block-7 {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    height: 100%;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.block-7 .img {
    height: 200px;
    position: relative;
    background-size: cover;
    background-position: center;
}

.block-7 .icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px;
    height: 100px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

.hero-wrap-2 {
    height: 400px;
    position: relative;
}
</style>

@endsection