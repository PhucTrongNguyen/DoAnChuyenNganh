<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiMatKinh;
use Illuminate\Database\QueryException;

class LoaiMatKinhController extends Controller
{
    public function index(){
        $lmk = LoaiMatKinh::all();
        
        return view("admin.loaimatkinh.review", compact("lmk"));
    }
    public function create()
    {
        return view('admin.loaimatkinh.create');
    }
    public function store(Request $request)
    {
        $request->validate(rules: [
            'TenLoai' => 'required|string|max:255',
        ]);

        //dd($request);

        try {
            $lmk = new LoaiMatKinh;
            $lmk->TenLoai = $request->input('TenLoai');
            $lmk->save();
            session()->flash('success', 'Loại mắt kính đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $lmk = LoaiMatKinh::findOrFail($id);
        return view('admin.loaimatkinh.edit', compact('lmk'));
    }
    public function update(Request $request, $id)
    {
        try {
            $lmk = LoaiMatKinh::findOrFail($id);
            $validated = $request->validate([
                'TenLoai' => 'required|string|max:255',
            ]);
            $lmk->update($validated);
            $lmk = LoaiMatKinh::all();
            session()->flash('success', 'Loại mắt kinh đã được cập nhật.');
            return view("admin.loaimatkinh.review", compact("lmk"));
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $lmk = LoaiMatKinh::findOrFail($id);
            $lmk->delete();
            $lmk = LoaiMatKinh::all();
            session()->flash('success', 'Loại mắt kính đã được xoá.');
            return view("admin.loaimatkinh.review", compact("lmk"));
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }
    public function restore() {
        try {
            LoaiMatKinh::onlyTrashed()->restore();
            $lmk = LoaiMatKinh::all();
            session()->flash('success', 'Loại mắt kính đã được phục hồi.');
            return view("admin.loaimatkinh.review", compact("lmk"));
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
}
