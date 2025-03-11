@extends('admin.index')
@include('admin.header')

<div class="container">
    <a href="{{ route('banners.create') }}" class="btn btn-primary my-3">Thêm Banner</a>

    <table class="table table-bordered">
        <tr>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        @foreach ($banners as $banner)
            <tr>
                <td>
                    @if($banner->image)
                        <img src="{{ url($banner->image) }}" width="100">
                    @else
                        Không có ảnh
                    @endif
                </td>
                <td>{{ $banner->title }}</td>
                <td>
                    <span class="badge {{ $banner->status ? 'bg-success' : 'bg-danger' }}">
                        {{ $banner->status ? 'Hiển thị' : 'Ẩn' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('banners.edit', $banner) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('banners.destroy', $banner) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa banner này?');">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="mt-3">
        {{ $banners->links() }}
    </div>
</div>
