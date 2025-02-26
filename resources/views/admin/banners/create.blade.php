@extends('admin.index')
@include('admin.header')

<div class="container">
    <h2 class="my-3">Thêm Banner</h2>
    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tiêu đề:</label>
            <input type="text" name="title" required class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh:</label>
            <input type="file" name="image" required class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày bắt đầu:</label>
            <input type="date" name="start_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày kết thúc:</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <select name="status" class="form-control">
                <option value="1">Hiển thị</option>
                <option value="0">Ẩn</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Thứ tự ưu tiên:</label>
            <input type="number" name="priority" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
