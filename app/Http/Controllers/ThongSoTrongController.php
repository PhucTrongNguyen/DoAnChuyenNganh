<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongSoTrong;
use Illuminate\Database\QueryException;

class ThongSoTrongController extends Controller
{
    public function index(){
        $tr = ThongSoTrong::all();
        
        return view("admin.thongsotrong.review", compact("tr"));
    }
    public function create()
    {
        return view('admin.thongsotrong.create');
    }
    public function store(Request $request)
    {
        $request->validate(rules: [
            'TenCLT' => 'required|string|max:255',
            'MauTrong' => 'required|string|max:255',
            'DoRongTrong' => 'required|integer|min:0',
            'DoCaoTrong' => 'required|integer|min:0',
        ]);

        //dd($request);

        try {
            $tr = new ThongSoTrong;
            $tr->TenCLT = $request->input('TenCLT');
            $tr->MauGong = $request->input('MauTrong');
            $tr->DoRongTrong = $request->input('DoRongTrong');
            $tr->DoCaoTrong = $request->input('DoCaoTrong');
            $tr->save();
            session()->flash('success', 'Thông số tròng đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $tr = ThongSoTrong::findOrFail($id);
        return view('admin.thongsotrong.edit', compact('tr'));
    }

    public function update(Request $request, $id)
    {
        try {
            $tr = ThongSoTrong::findOrFail($id);
            $validated = $request->validate([
                'TenCLT' => 'required|string|max:255',
                'MauTrong' => 'required|string|max:255',
                'DoRongTrong' => 'required|integer|min:0',
                'DoCaoTrong' => 'required|integer|min:0',
            ]);
            $tr->update($validated);
    
            session()->flash('success', 'Thông số tròng đã được cập nhật.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $tr = ThongSoTrong::findOrFail($id);
            //$tr->NgayXoaCLT = now();
            $tr->delete();
    
            session()->flash('success', 'Thông số tròng đã được xoá.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }
}
