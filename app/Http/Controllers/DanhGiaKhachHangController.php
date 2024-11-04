<?php

namespace App\Http\Controllers;

use App\Models\DanhGiaKhachHang;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DanhGiaKhachHangController extends Controller
{
    //
    public function index(){
        $dg = DanhGiaKhachHang::with('khachHang')->get();
        
        return view("admin.danhgiakhachhang.review", compact("dg"));
    }
    public function create()
    {
        return view('admin.danhgiakhachhang.create');
    }
    public function store(Request $request)
    {
        $request->validate(rules: [
            'MaKH' => 'required',
            'NoiDungDanhGia' => 'required'
        ]);

        //dd($request);

        try {
            $dg = new DanhGiaKhachHang;
            $dg->MaKH = $request->input('MaKH');
            $dg->NoiDungDanhGia = $request->input('NoiDungDanhGia');
            $dg->save();
            session()->flash('success', 'Đánh giá đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $dg = DanhGiaKhachHang::findOrFail($id);
        return view('admin.danhgiakhachhang.edit', compact('dg'));
    }
    public function update(Request $request, $id)
    {
        try {
            $dg = DanhGiaKhachHang::findOrFail($id);
            $validated = $request->validate([
                'MaKH' => 'required',
                'NoiDungDanhGia' => 'required'
            ]);
            $dg->update($validated);
    
            session()->flash('success', 'Đánh giá đã được cập nhật.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $dg = DanhGiaKhachHang::findOrFail($id);
            $dg->delete();
    
            session()->flash('success', 'Đánh giá đã được xoá.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }
}
