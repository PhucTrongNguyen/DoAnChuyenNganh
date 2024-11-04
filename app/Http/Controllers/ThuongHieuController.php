<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThuongHieu;
use Illuminate\Database\QueryException;

class ThuongHieuController extends Controller
{
    public function index(){
        $th = ThuongHieu::all();
        
        return view("admin.thuonghieu.review", compact("th"));
    }
    public function create()
    {
        return view('admin.thuonghieu.create');
    }

    public function store(Request $request)
    {
        $request->validate(rules: [
            'TenTH' => 'required|string|max:255',
        ]);

        //dd($request);

        try {
            $th = new ThuongHieu;
            $th->TenTH = $request->input('TenTH');
            $th->save();
            session()->flash('success', 'Thương hiệu đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $th = ThuongHieu::findOrFail($id);
            $validated = $request->validate([
                'TenTH' => 'required|string|max:255',
            ]);
            $th->update($validated);
    
            session()->flash('success', 'Thương hiệu đã được cập nhật.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $th = ThuongHieu::findOrFail($id);
        return view('admin.thuonghieu.edit', compact('th'));
    }
    public function destroy($id)
    {
        try {
            $th = ThuongHieu::findOrFail($id);
            $th->delete();
    
            session()->flash('success', 'Thương hiệu đã được xoá.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }
}
