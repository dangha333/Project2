<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .sidebar {
            min-height: 100vh;
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        @include('layouts.partials.slidebar')

        <!-- Nội dung chính -->
        <div class="flex-grow-1 p-4">
            @include('layouts.partials.header')

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->

    @include('layouts.partials.footer')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>