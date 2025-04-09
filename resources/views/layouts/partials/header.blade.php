<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand brand-logo" href="{{ url('/') }}">Áo Xinh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/shop') }}">Sản Phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">Giới Thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Liên Hệ</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/cart') }}">🛒 Giỏ Hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Đăng Nhập</a></li>
                </ul>
            </div>
        </div>
    </nav>