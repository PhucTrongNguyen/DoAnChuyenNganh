<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiQuanLy;
use Illuminate\Database\QueryException;

class NguoiQuanLyController extends Controller
{
    public function index()
    {
        $ql = NguoiQuanLy::all();
        return view("admin.nguoiquanly.review", compact('ql'));
    }
    public function create()
    {
        return view('admin.nguoiquanly.create');
    }
    public function store(Request $request)
    {
        $request->validate(rules: [
            'TenQL' => 'required|string|max:255',
            'GioiTinh' => 'required|string|max:10',
            'NgaySinh' => 'required|date',
            'Email' => 'required|email|max:255',
            'MatKhau' => [
                'required',
                'string',
                'min:8',            // Mật khẩu ít nhất 8 ký tự
                'regex:/[a-z]/',    // Ít nhất một chữ thường
                'regex:/[A-Z]/',    // Ít nhất một chữ hoa
                'regex:/[0-9]/',    // Ít nhất một số
                'regex:/[@$!%*?&#]/', // Ít nhất một ký tự đặc biệt
            ],
            'ChucVu' => 'required|string|max:255',
            'DiaChi' => 'required|string|max:1000',
            'TrangThaiTaiKhoan' => 'required',
        ]);

        //dd($request);


        // //SanPham::create($validated);

        try {
            $ql = new NguoiQuanLy;
            $ql->TenQL = $request->input('TenQL');
            $ql->GioiTinh = $request->input('GioiTinh');
            $ql->NgaySinh = $request->input('NgaySinh');
            $ql->Email = $request->input('Email');
            $ql->MatKhau = $request->input('MatKhau');
            $ql->ChucVu = $request->input('ChucVu');
            $ql->DiaChi = $request->input('DiaChi');
            $ql->TrangThaiTaiKhoan = $request->input('TrangThaiTaiKhoan');
            $ql->save();

            session()->flash('success', 'Thông tin đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $ql = NguoiQuanLy::findOrFail($id);
        //dd($sanPham);
        return view('admin.nguoiquanly.edit', compact('ql'));
    }
    public function update(Request $request, $id)
    {
        $ql = NguoiQuanLy::findOrFail($id);
        //dd($sanPham);
        $validated = $request->validate([
            'TenQL' => 'required|string|max:255',
            'GioiTinh' => 'required|string|max:10',
            'NgaySinh' => 'required|date',
            'Email' => 'required|email|max:255',
            'MatKhau' => [
                'required',
                'string',
                'min:8',            // Mật khẩu ít nhất 8 ký tự
                'regex:/[a-z]/',    // Ít nhất một chữ thường
                'regex:/[A-Z]/',    // Ít nhất một chữ hoa
                'regex:/[0-9]/',    // Ít nhất một số
                'regex:/[@$!%*?&#]/', // Ít nhất một ký tự đặc biệt
            ],
            'ChucVu' => 'required|string|max:255',
            'DiaChi' => 'required|string|max:1000',
            'TrangThaiTaiKhoan' => 'required',
        ]);

        $ql->update($validated);

        session()->flash('success', 'Thông tin đã được cập nhật.');
        return redirect()->route('admin.nguoiquanly.review');
    }
    public function destroy($id)
    {
        $ql = NguoiQuanLy::findOrFail($id);
        $ql->delete();

        return redirect()->route('admin.nguoiquanly.review')->with('success', 'Thông tin đã được xóa.');
    }
}
