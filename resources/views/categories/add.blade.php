@extends('layouts.main')

@section('title', 'Thêm danh mục mới')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">➕ Thêm danh mục mới</h2>

    <form action="{{ route('addPostCategory') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('listCategory') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
        </div>
    </form>
</div>
@endsection
