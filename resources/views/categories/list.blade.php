
@extends('layouts.main')

@section('title', 'Danh sách danh mục')

@push('styles')
@endpush

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">

        
        <a href="{{ route('addCategory') }}" class="btn btn-success">➕ Thêm danh mục</a>
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
                <th>Tên danh mục</th>
                <th>Ngày tạo</th>
                <th>Ngày sửa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $category->updated_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <a href="{{ route('updateCategory', $category->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                        <form action="{{ route('deleteCategory', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('scripts')

@endpush