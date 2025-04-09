@extends('layouts.main')

@section('title', 'Sửa danh mục')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Sửa danh mục</h2>

    <form action="{{ route('updatePatchCategory', $category->id) }}" method="POST">
        @csrf
    @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ $category->name }}">
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('listCategory') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Sửa danh mục</button>
        </div>
    </form>
</div>
@endsection
