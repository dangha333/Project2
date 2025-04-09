
@extends('layouts.main')

@section('title', 'Danh sách sản phẩm')

@push('styles')
@endpush

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">

        
        <a href="{{ route('addProduct') }}" class="btn btn-success">➕ Thêm sản phẩm</a>
        <form method="GET" action="{{ route('listProduct') }}" class="d-flex align-items-center">
        <label for="per_page" class="me-2">Hiển thị:</label>
        <select name="per_page" id="per_page" class="form-select me-2" onchange="this.form.submit()">
            <option value="7" {{ request('per_page') == 7 ? 'selected' : '' }}>7</option>
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Tất cả</option>
        </select>
    </form>
    </div>
    
    @if (session('message'))
            <div class="alert alert-primary" role="alert">
                {{session('message') }}
            </div>

        @endif

    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Ngày tạo</th>
                <th>Ngày sửa</th>
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
                    <td>{{ $product->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $product->updated_at->format('d/m/Y H:i:s') }}</td>
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
    {{ $listProduct->links('pagination::bootstrap-5') }}
    <!-- Phân trang -->
   
</div>

@endsection

@push('scripts')

@endpush