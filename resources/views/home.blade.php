@extends('layouts.main')

@section('title', 'Bảng điều khiển')

@section('content')
<div class="container-fluid">
    <!-- Tổng quan -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm</h5>
                    <p class="card-text fs-4">128</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Danh mục</h5>
                    <p class="card-text fs-4">12</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng</h5>
                    <p class="card-text fs-4">57</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Người dùng</h5>
                    <p class="card-text fs-4">23</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ (placeholder) -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Thống kê doanh thu</div>
                <div class="card-body">
                    <div class="text-muted text-center">[ Biểu đồ doanh thu sẽ hiển thị tại đây ]</div>
                    <div class="text-center mt-3">
                        <img src="https://via.placeholder.com/600x200?text=Chart" class="img-fluid" alt="Biểu đồ">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Trạng thái hệ thống</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Máy chủ: <span class="badge bg-success">Online</span></li>
                        <li class="list-group-item">Thanh toán: <span class="badge bg-success">Đang hoạt động</span></li>
                        <li class="list-group-item">Email: <span class="badge bg-warning text-dark">Chậm</span></li>
                        <li class="list-group-item">Tồn kho: <span class="badge bg-danger">Kiểm tra lại</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Đơn hàng gần đây -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-white fw-bold">🧾 Đơn hàng gần đây</div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#DH001</td>
                        <td>Nguyễn Văn A</td>
                        <td><span class="badge bg-success">Hoàn tất</span></td>
                        <td>1.200.000₫</td>
                        <td>08/04/2025</td>
                    </tr>
                    <tr>
                        <td>#DH002</td>
                        <td>Trần Thị B</td>
                        <td><span class="badge bg-warning text-dark">Đang xử lý</span></td>
                        <td>890.000₫</td>
                        <td>08/04/2025</td>
                    </tr>
                    <tr>
                        <td>#DH003</td>
                        <td>Phạm Văn C</td>
                        <td><span class="badge bg-danger">Hủy</span></td>
                        <td>460.000₫</td>
                        <td>07/04/2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
