<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaChi;
use Illuminate\Database\QueryException;

class DiaChiController extends Controller
{
    public function index(){
        $dc = DiaChi::all();
        
        return view("admin.diachi.review", compact("dc"));
    }
    public function create()
    {
        return view('admin.diachi.create');
    }
    public function store(Request $request)
    {
        $request->validate(rules: [
            'LoaiDC' => 'required|string|max:255',
            'Duong' => 'required|string|max:255',
            'Phuong' => 'required|string|max:255',
            'Quan' => 'required|string|max:255',
            'ThanhPho' => 'required|string|max:255',
        ]);

        //dd($request);

        try {
            $dc = new DiaChi;
            $dc->LoaiDC = $request->input('LoaiDC');
            $dc->ThongTinDC = $request->input('ThongTinDC');
            $dc->save();
            session()->flash('success', 'Địa chỉ đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $dc = DiaChi::findOrFail($id);
        return view('admin.diachi.edit', compact('dc'));
    }
    public function update(Request $request, $id)
    {
        try {
            $dc = DiaCHi::findOrFail($id);
            $validated = $request->validate([
                'LoaiDC' => 'required|string|max:255',
                'Duong' => 'required|string|max:255',
                'Phuong' => 'required|string|max:255',
                'Quan' => 'required|string|max:255',
                'ThanhPho' => 'required|string|max:255',
            ]);
            $dc->update($validated);
    
            session()->flash('success', 'Địa chỉ đã được cập nhật.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $dc = DiaChi::findOrFail($id);
            $dc->delete();
    
            session()->flash('success', 'Địa chỉ đã được xoá.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }
}
