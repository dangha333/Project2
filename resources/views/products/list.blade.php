
@extends('layouts.main')

@section('title', 'Danh sách sản phẩm')

@push('styles')
@endpush

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Danh sách sản phẩm</h2>
        <a href="{{ route('addProduct') }}" class="btn btn-success">➕ Thêm sản phẩm</a>
    </div>

    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listProduct as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }}₫</td>
                    <td>{{ $product->categoryName }}</td>
                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('updateProduct', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                        <form action="{{ route('deleteProduct', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        {{ $listProduct->links() }}
    </div>
</div>

@endsection

@push('scripts')

@endpush