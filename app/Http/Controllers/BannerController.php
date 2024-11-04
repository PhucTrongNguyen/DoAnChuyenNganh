<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class BannerController extends Controller
{
    public function store(Request $request) {
        $request->validate(rules: [
            'AnhBanner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        try {
            if ($request->hasFile('AnhBanner')) {
                // Lưu file vào thư mục public/uploads
                $fileName = time() . '.' . $request->AnhBanner->getClientOriginalExtension();
                $request->AnhBanner->move(public_path('banners'), $fileName);
            }
            session()->flash('success', 'Banner đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function create(Request $request)
    {
        return view('admin.banner.create');
    }

    // Phương thức sửa banner
    public function edit($filename)
    {
        return view('admin.banner.edit', compact('filename'));
    }

    public function update(Request $request, $filename)
    {
        $request->validate(rules: [
            'AnhBanner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            // Đường dẫn đến file cũ
            $oldPath = public_path('banners/' . $filename);
            //dd($oldPath);
            if (file_exists($oldPath)) {
                // Xóa file cũ
                File::delete($oldPath);
                // if (file_exists(public_path($sanpham->AnhSP))) {
                //     unlink(public_path($sanpham->AnhSP));
                // }

                // Tải file mới lên
                $newFilename = time() . '.' . $request->AnhBanner->extension();
                $request->AnhBanner->move(public_path('banners'), $newFilename);

                $banners = array_filter(File::files(public_path('banners')), function ($file) {
                    return in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif']);
                });

                //return redirect()->back()->with('success', 'Banner đã được cập nhật thành công!');
                session()->flash('success', 'Banner đã được cập nhật thành công!');
                return view("admin.banner.review", compact("banners"));
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy banner!');
            }
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

    }

    public function index()
    {
        // Lấy danh sách các file ảnh trong thư mục public/banner
        $banners = array_filter(File::files(public_path('banners')), function ($file) {
            return in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif']);
        });

        return view('admin.banner.review', compact('banners'));
    }
}
