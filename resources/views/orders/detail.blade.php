@extends('layouts.main')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container">
    <h2 class="my-4">🧾 Chi tiết đơn hàng #{{ $orderDetail->id }}</h2>

    <p><strong>Người đặt:</strong> {{ $orderDetail->user->name ?? 'Không rõ' }}</p>
    <p><strong>Ngày đặt:</strong> {{ $orderDetail->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Trạng thái:</strong> {{ ucfirst($orderDetail->status) }}</p>

    <hr>

    <h5>🛒 Danh sách sản phẩm:</h5>
    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetail->orderDetails as $detail)
    <tr>
        <td>{{ $detail->product->name ?? 'Không rõ' }}</td>
        <td>{{ number_format($detail->price, 0, ',', '.') }}₫</td>
        <td>{{ $detail->quantity }}</td>
        <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}₫</td>
    </tr>
@endforeach
        </tbody>
    </table>

    @php
    $total = $orderDetail->orderDetails->sum(function($item) {
        return $item->price * $item->quantity;
    });
@endphp

<h4>Tổng tiền: <strong class="text-danger">{{ number_format($total, 0, ',', '.') }}₫</strong></h4>

    <a href="{{ route('listOrder') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
</div>
@endsection
