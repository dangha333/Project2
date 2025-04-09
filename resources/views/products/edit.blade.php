@extends('layouts.main')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Sửa sản phẩm</h2>

    <form action="{{ route('updateProduct', $product->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required value="{{ old('name') }}" >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>


        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required min="0" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('listProduct') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
        </div>
    </form>
</div>
@endsection
