<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhaCungCap;
use Illuminate\Database\QueryException;

class NhaCungCapController extends Controller
{
    public function index(){
        $ncc = NhaCungCap::all();
        
        return view("admin.nhacungcap.review", compact("ncc"));
    }
    public function create()
    {
        return view('admin.nhacungcap.create');
    }

    public function store(Request $request)
    {
        $request->validate(rules: [
            'TenNCC' => 'required|string|max:255',
            'DiaChiNCC' => 'required|string|max:255',
            'MoTa' => 'required|string|max:2000',
        ]);

        //dd($request);

        try {
            $ncc = new NhaCungCap;
            $ncc->TenNCC = $request->input('TenNCC');
            $ncc->DiaChiNCC = $request->input('DiaChiNCC');
            $ncc->MoTa = $request->input('MoTa');
            $ncc->save();
            session()->flash('success', 'Nhà cung cấp đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $ncc = NhaCungCap::findOrFail($id);
        return view('admin.nhacungcap.edit', compact('ncc'));
    }
    public function update(Request $request, $id)
    {
        try {
            $ncc = NhaCungCap::findOrFail($id);
            $validated = $request->validate([
                'TenNCC' => 'required|string|max:255',
                'DiaChiNCC' => 'required|string|max:255',
                'MoTa' => 'required|string|max:2000',
            ]);
            $ncc->update($validated);
    
            session()->flash('success', 'Nhà cung cấp đã được cập nhật.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $ncc = NhaCungCap::findOrFail($id);
            $ncc->delete();
    
            session()->flash('success', 'Nhà cung cấp đã được xoá.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }
}
