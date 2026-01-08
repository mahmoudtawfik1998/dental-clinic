<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم - عيادة الأسنان')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    
    <!-- CSS Files -->
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
    
<style>
    * {
        font-family: 'Cairo', sans-serif !important;
    }
    
    body {
        background: #f8f9fa;
    }
    
    /* Sidebar */
    .admin-sidebar {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        min-height: 100vh;
        padding: 20px 0;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .admin-sidebar .nav-link {
        color: #ecf0f1;
        padding: 15px 25px;
        border-radius: 8px;
        margin: 5px 15px;
        transition: all 0.3s;
        font-weight: 600;
    }
    
    .admin-sidebar .nav-link:hover {
        background: rgba(52, 152, 219, 0.2);
        color: #fff;
        transform: translateX(-5px);
    }
    
    .admin-sidebar .nav-link.active {
        background: #3498db;
        color: #fff;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
    }
    
    .admin-sidebar .nav-link i {
        margin-left: 10px;
        font-size: 18px;
    }
    
    /* Content */
    .admin-content {
        padding: 30px;
        animation: fadeIn 0.5s;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Cards */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }
    
    .card:hover {
        box-shadow: 0 5px 25px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    
    /* Tables */
    .table {
        font-size: 14px;
    }
    
    .table thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    /* Badges */
    .badge {
        padding: 6px 12px;
        font-weight: 600;
        border-radius: 20px;
    }
    
    /* Buttons */
    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        border: none;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        border: none;
    }
    
    /* Avatar */
    .avatar {
        font-size: 16px;
        font-weight: bold;
    }
    
    /* Navbar Dropdown */
    .navbar .dropdown-menu {
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    
    .navbar .dropdown-item {
        padding: 10px 20px;
        transition: all 0.3s;
    }
    
    .navbar .dropdown-item:hover {
        background: #f8f9fa;
        padding-right: 25px;
    }
    
    /* Custom File Input */
    .custom-file-label {
        text-align: right;
    }
    
    .custom-file-label::after {
        content: "تصفح";
        left: 0;
        right: auto;
    }
    
    /* Alert */
    .alert {
        border-radius: 10px;
        border: none;
    }
    
    /* Spinner */
    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
    }
</style>    
    @yield('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="">عيادة<span>الأسنان</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
                <span class="oi oi-menu"></span> القائمة
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="" class="nav-link">الرئيسية</a></li>
                    <li class="nav-item"><a href="{{ route('appointments.create') }}" class="nav-link">حجز موعد</a></li>
                    <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">لوحة التحكم</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                            
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 admin-sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="icon-home mr-2"></i> الرئيسية
                    </a>
                    <a class="nav-link {{ Request::is('admin/appointments*') ? 'active' : '' }}" href="{{ route('admin.appointments') }}">
                        <i class="icon-calendar mr-2"></i> الحجوزات
                    </a>
                    <a class="nav-link {{ Request::is('admin/doctors*') ? 'active' : '' }}" href="{{ route('admin.doctors') }}">
                        <i class="icon-user mr-2"></i> الدكاترة
                    </a>
                    <a class="nav-link {{ Request::is('admin/patients*') ? 'active' : '' }}" href="{{ route('admin.patients') }}">
                        <i class="icon-users mr-2"></i> المرضى
                    </a>
                    <a class="nav-link" href="{{ route('appointments.create') }}">
                        <i class="icon-plus mr-2"></i> حجز جديد
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 admin-content">
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>نجاح!</strong> {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>خطأ!</strong> {{ session('error') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>يوجد أخطاء:</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
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

    @yield('scripts')
</body>
</html>