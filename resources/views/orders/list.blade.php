
@extends('layouts.main')

@section('title', 'Danh sách đơn hàng')

@push('styles')
@endpush

@section('content')

<div class="container">
  

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Người đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->userName ?? 'Không rõ' }}</td>
                    <td>{{ number_format($order->total, 0, ',', '.') }}₫</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning">Chờ xử lý</span>
                        @elseif($order->status == 'completed')
                            <span class="badge bg-success">Hoàn thành</span>
                        @elseif($order->status == 'cancelled')
                            <span class="badge bg-danger">Đã hủy</span>
                        @else
                            <span class="badge bg-secondary">Không xác định</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('listOrderDetail', $order->id) }}" class="btn btn-sm btn-info">Chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

@push('scripts')

@endpush