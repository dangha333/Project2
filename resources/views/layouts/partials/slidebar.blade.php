<nav class="bg-dark text-white p-3 sidebar" style="width: 250px;">
        <h4 class="text-white mb-4">🛠️ Quản trị</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('home') }}" class="nav-link text-white"> Dashboard</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('listProduct') }}" class="nav-link text-white"> Sản phẩm</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('listCategory') }}" class="nav-link text-white"> Danh mục</a>
            </li>
            <li class="nav-item mb-2">
                <a href="" class="nav-link text-white"> Đơn hàng</a>
            </li>
            <li class="nav-item mb-2">
                <a href="" class="nav-link text-white"> Giỏ hàng</a>
            </li>
            <li class="nav-item mt-3">
                <a href="" class="nav-link text-danger"> Đăng xuất</a>
            </li>
        </ul>
    </nav>