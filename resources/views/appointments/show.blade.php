@extends('layouts.index')

@section('title', $service->name . ' - عيادة الأسنان')

@section('content')

<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">{{ $service->name }}</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">الرئيسية <i class="ion-ios-arrow-forward"></i></a></span>
                    <span class="mr-2"><a href="{{ route('services.index') }}">الخدمات <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>{{ $service->name }}</span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Service Details -->
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <!-- محتوى الخدمة -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body p-5">
                        <!-- أيقونة الخدمة -->
                        <div class="text-center mb-4">
                            <div class="service-icon" style="background-color: {{ $service->color }}20; display: inline-block; padding: 30px; border-radius: 50%;">
                                <span style="font-size: 80px;">
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
                        
                        <h2 class="mb-4">{{ $service->name }}</h2>
                        
                        <!-- معلومات الخدمة -->
                        <div class="service-info mb-4 p-4" style="background-color: {{ $service->color }}10; border-radius: 10px;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <i class="icon-clock" style="color: {{ $service->color }};"></i>
                                    <strong>المدة:</strong> {{ $service->duration }} دقيقة
                                </div>
                                @if($service->price)
                                <div class="col-md-6 mb-3">
                                    <i class="icon-money" style="color: {{ $service->color }};"></i>
                                    <strong>السعر:</strong> {{ $service->price }} جنيه
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- وصف الخدمة -->
                        <h4 class="mb-3">نبذة عن الخدمة</h4>
                        <p class="text-justify">
                            {{ $service->name }} هي واحدة من الخدمات المتميزة التي نقدمها في عيادتنا. نستخدم أحدث التقنيات والأجهزة الطبية لضمان أفضل النتائج وراحة المريض.
                        </p>
                        
                        <!-- مميزات الخدمة -->
                        <h4 class="mb-3 mt-5">مميزات الخدمة</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="icon-check text-success mr-2"></i>
                                استخدام أحدث التقنيات والأجهزة الطبية
                            </li>
                            <li class="mb-3">
                                <i class="icon-check text-success mr-2"></i>
                                فريق طبي متخصص وذو خبرة عالية
                            </li>
                            <li class="mb-3">
                                <i class="icon-check text-success mr-2"></i>
                                بيئة معقمة ونظيفة تلتزم بأعلى معايير الجودة
                            </li>
                            <li class="mb-3">
                                <i class="icon-check text-success mr-2"></i>
                                راحة المريض أولويتنا القصوى
                            </li>
                            <li class="mb-3">
                                <i class="icon-check text-success mr-2"></i>
                                أسعار تنافسية وعروض مميزة
                            </li>
                        </ul>
                        
                        <!-- زر الحجز -->
                        <div class="text-center mt-5">
                            @auth
                            <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-lg px-5 py-3">
                                احجز موعدك الآن
                            </a>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3">
                                سجل دخولك للحجز
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- معلومات سريعة -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">معلومات سريعة</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 pb-3 border-bottom">
                                <strong>المدة:</strong><br>
                                {{ $service->duration }} دقيقة
                            </li>
                            @if($service->price)
                            <li class="mb-3 pb-3 border-bottom">
                                <strong>السعر:</strong><br>
                                {{ $service->price }} جنيه
                            </li>
                            @endif
                            <li>
                                <strong>متوفر لدى:</strong><br>
                                جميع أطبائنا المتخصصين
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- خدمات أخرى -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">خدمات أخرى</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach(App\Models\Service::where('id', '!=', $service->id)->take(5)->get() as $otherService)
                            <a href="{{ route('services.show', $otherService->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <span>{{ $otherService->name }}</span>
                                    <i class="icon-arrow-left"></i>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection