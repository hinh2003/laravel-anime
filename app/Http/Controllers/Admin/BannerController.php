<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    // Danh sách banner
    public function index()
    {
        $banners = Banner::orderBy('priority', 'desc')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request, UploadImage $uploadImage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $uploadImage->upload($request->file('image'), 'banners');

        Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status ?? 0,
            'priority' => $request->priority ?? 0,
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner đã được thêm!');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner, UploadImage $uploadImage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $imagePath = $uploadImage->upload($request->file('image'), 'banners');
        } else {
            $imagePath = $banner->image;
        }

        $banner->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status ?? 0,
            'priority' => $request->priority ?? 0,
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner đã được cập nhật!');
    }


    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->image);
        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Banner đã được xóa!');
    }
}
