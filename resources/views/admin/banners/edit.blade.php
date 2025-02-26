@extends('admin.index')
@include('admin.header')

<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="mb-3 text-center text-dark">Sửa Banner</h2>

        <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label text-dark">Tiêu đề:</label>
                <input type="text" name="title" required class="form-control" value="{{ old('title', $banner->title) }}">
            </div>

            <div class="mb-3">
                <label class="form-label text-dark">Ảnh hiện tại:</label><br>
                @if ($banner->image)
                    <img src="{{ asset($banner->image) }}" width="100" class="mb-2 rounded shadow">
                @endif
                <input type="file" name="image" class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-dark">Ngày bắt đầu:</label>
                    <input type="date" name="start_date" class="form-control"
                           value="{{ old('start_date', $banner->start_date ? \Carbon\Carbon::parse($banner->start_date)->format('Y-m-d') : '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-dark">Ngày kết thúc:</label>
                    <input type="date" name="end_date" class="form-control"
                           value="{{ old('end_date', $banner->end_date ? \Carbon\Carbon::parse($banner->end_date)->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-dark">Trạng thái:</label>
                <select name="status" class="form-select">
                    <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label text-dark">Thứ tự ưu tiên:</label>
                <input type="number" name="priority" class="form-control" value="{{ old('priority', $banner->priority) }}">
            </div>

            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
        </form>
    </div>
</div>
