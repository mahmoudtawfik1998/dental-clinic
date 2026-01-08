<!DOCTYPE html>
<html lang="en">

<head>
    <title>DentaCare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<script>
// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if(target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>
<script>
// إضافة Loading State للنماذج
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        if(submitBtn && !submitBtn.classList.contains('disabled')) {
            submitBtn.classList.add('disabled');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2"></span>جاري المعالجة...';
        }
    });
});

// إخفاء الرسائل تلقائياً بعد 5 ثواني
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(alert => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);
</script>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">عيادة<span>الأسنان</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
            <span class="oi oi-menu"></span> القائمة
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">الرئيسية</a>
                </li>

                <li class="nav-item">
                    <a href="#services" class="nav-link">الخدمات</a>
                </li>
                <li class="nav-item">
                    <a href="#doctors" class="nav-link">الأطباء</a>
                </li>

                <li class="nav-item">
                    <a href="#contact" class="nav-link">تواصل معنا</a>
                </li>
                
@guest
<li class="nav-item cta">
    <a href="{{ route('login') }}" class="nav-link">
        <span>تسجيل الدخول</span>
    </a>
</li>
@else
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
        {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{{ route('appointments.create') }}">
            <i class="icon-calendar"></i> حجز موعد
        </a>
        @if(Auth::user()->role === 'admin')
        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
            <i class="icon-home"></i> لوحة التحكم
        </a>
        @endif
        <div class="dropdown-divider"></div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item">
                <i class="icon-logout"></i> تسجيل الخروج
            </button>
        </form>
    </div>
</li>
@endguest            </ul>
        </div>
    </div>
</nav>

    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center">
                    <div class="col-md-6 col-sm-12 ftco-animate">
                        <h1 class="mb-4">طب أسنان حديث في بيئة هادئة ومريحة</h1>
                        <p class="mb-4">نوفر لك أفضل خدمات طب الأسنان باستخدام أحدث التقنيات والأجهزة الطبية</p>
                        <p>
                            <a href="{{ route('appointments.create') }}" class="btn btn-primary px-4 py-3">احجز موعدك الآن</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image: url('{{ asset('assets/images/bg_2.jpg') }}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center">
                    <div class="col-md-6 col-sm-12 ftco-animate">
                        <h1 class="mb-4">احصل على الابتسامة المثالية التي تحلم بها</h1>
                        <p class="mb-4">فريق من أفضل أطباء الأسنان المتخصصين في خدمتك</p>
                        <p>
                            <a href="{{ route('appointments.create') }}" class="btn btn-primary px-4 py-3">سجل الآن</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Info Section -->
    <section class="ftco-intro">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-3 color-1 p-4">
                    <h3 class="mb-4">حالات الطوارئ</h3>
                    <p>نحن متاحون على مدار الساعة للحالات الطارئة</p>
                    <span class="phone-number">0100589655</span>
                </div>
                <div class="col-md-3 color-2 p-4">
                    <h3 class="mb-4">ساعات العمل</h3>
                    <p class="openinghours d-flex">
                        <span>السبت - الخميس</span>
                        <span>8:00 - 19:00</span>
                    </p>
                    <p class="openinghours d-flex">
                        <span>الجمعة</span>
                        <span>مغلق</span>
                    </p>
                </div>
                <div class="text-center col-md-6 color-3 p-3">
                    <h3 class="mb-2">العنوان</h3>
                    <p class="openinghours d-flex">
                        
                        <h3>قنا - ميدان الساعة - برج الزهور</h3>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Services Section -->
    <section class="ftco-section ftco-services" id="services">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-2">خدماتنا تبقيك مبتسماً</h2>
                    <p>نقدم مجموعة شاملة من خدمات طب الأسنان بأعلى جودة</p>
                </div>
            </div>
            <div class="row">
                @foreach($services as $service)
                    <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services d-block text-center">
                            <div class="icon d-flex justify-content-center align-items-center" style="background-color: ">
                                <span class="flaticon-tooth-1"></span>
                            </div>
                            <div class="media-body p-2 mt-3">
                                <h3 class="heading">{{ $service->name }}</h3>

                                @if($service->price)
                                    <p class="font-weight-bold">{{ $service->price }} جنيه</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    >


    <!-- Doctors Section -->
    <section class="ftco-section" id="doctors">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-3">تعرف على أطبائنا المتميزين</h2>
                    <p>فريق من أفضل أطباء الأسنان ذوي الخبرة والكفاءة العالية</p>
                </div>
            </div>
            <div class="row">
                @foreach($doctors as $doctor)
                    <div class="col-lg-3 col-md-6 d-flex mb-sm-4 ftco-animate">
                        <div class="staff">

                            <div class="img mb-4" style="
                            min-height: 300px;
                            background-image: url('{{ asset('assets/images/doctors/' . ($loop->index + 1) . '.jpg') }}');
                            background-size: cover;
                            background-position: center;
                            border-radius: 8px;
                        ">
                            </div>

                            <div class="info text-center">
                                <h3>{{ $doctor->name }}</h3>
                                <span class="position">{{ $doctor->specialty }}</span>

                                <div class="text">
                                    @if($doctor->phone)
                                        <p>{{ $doctor->phone }}</p>
                                    @endif
                                    @if($doctor->work_days)
                                        <p class="text-muted small">
                                            {{ implode(', ', array_slice($doctor->work_days, 0, 3)) }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>


    <!-- Stats Section -->
    <section class="ftco-section ftco-counter img" id="section-counter"
        style="background-image: url({{ asset('assets/images/bg_1.jpg') }});">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-3 aside-stretch py-5">
                    <div class="heading-section heading-section-white ftco-animate pr-md-4">
                        <h2 class="mb-3">إنجازاتنا</h2>
                        <p>أرقام تتحدث عن تميزنا وثقة عملائنا</p>
                    </div>
                </div>
                <div class="col-md-9 py-5 pl-md-5">
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="text">
                                    <strong class="number" data-number="3"></strong>
                                    <span>طبيب متخصص</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="text">
                                    <strong class="number" data-number="100">0</strong>
                                    <span>مريض راضٍ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="text">
                                    <strong class="number" data-number="10">0</strong>
                                    <span>حجز مكتمل</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="text">
                                    <strong class="number" data-number="15">0</strong>
                                    <span>سنة خبرة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="ftco-section" id="pricing">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-3">أفضل الأسعار</h2>
                    <p>أسعار تنافسية وعروض مميزة على جميع الخدمات</p>
                </div>
            </div>
            <div class="row">
                @foreach($services->take(4) as $service)
                    <div class="col-md-3 ftco-animate">
                        <div class="pricing-entry pb-5 text-center">
                            <div>
                                <h3 class="mb-4">{{ $service->name }}</h3>
                                @if($service->price)
                                    <p><span class="price">{{ $service->price }}</span> <span class="per">جنيه</span></p>
                                @else
                                    <p><span class="price">حسب الحالة</span></p>
                                @endif
                            </div>
                            <ul>
                                <li>استشارة مجانية</li>
                                <li>فحص شامل</li>

                                <li>ضمان الجودة</li>
                            </ul>
                            <p class="button text-center">
                                <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-outline-primary px-4 py-3">احجز الآن</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">عيادة الأسنان</h2>
                        <p>نقدم أفضل خدمات طب الأسنان بأحدث التقنيات وأعلى جودة</p>
                    </div>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">روابط سريعة</h2>
                        <ul class="list-unstyled">
                            <li><a href="#about" class="py-2 d-block">من نحن</a></li>
                            <li><a href="#services" class="py-2 d-block">الخدمات</a></li>
                            <li><a href="#doctors" class="py-2 d-block">الأطباء</a></li>
                            <li><a href="#pricing" class="py-2 d-block">الأسعار</a></li>
                            <li><a href="#contact" class="py-2 d-block">تواصل معنا</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">خدماتنا</h2>
                        <ul class="list-unstyled">
                            @foreach($services->take(5) as $service)
                                <li><a href="" class="py-2 d-block">{{ $service->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">العنوان</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">قنا , ميدان الساعة -برج
                                        الزهور</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span
                                            class="text">0115236485</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">DentaCare.come</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>© 2024 عيادة الأسنان - جميع الحقوق محفوظة</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>