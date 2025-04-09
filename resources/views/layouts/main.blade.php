<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Áo Xinh - Shop Thời Trang')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Segoe UI', sans-serif; }
        .brand-logo { font-size: 24px; font-weight: bold; color: #ff4081; }
        footer { background-color: #f8f9fa; padding: 20px 0; text-align: center; margin-top: 40px; }
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">


    <!-- Header + Navbar -->
    @include('layouts.partials.header')

    <!-- Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
   @include('layouts.partials.footer')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts') <!-- Cho phép thêm JS riêng từ view con -->
</body>
</html>
