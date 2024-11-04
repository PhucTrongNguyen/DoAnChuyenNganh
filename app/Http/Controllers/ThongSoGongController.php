<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\ThongSoGong;

class ThongSoGongController extends Controller
{
    public function index(){
        $g = ThongSoGong::all();
        
        return view("admin.thongsogong.review", compact("g"));
    }
    public function create()
    {
        return view('admin.thongsogong.create');
    }
    public function store(Request $request)
    {
        $request->validate(rules: [
            'TenCLG' => 'required|string|max:255',
            'MauGong' => 'required|string|max:255',
            'ChieuDaiGongKinh' => 'required|integer|min:0',
            'ChieuRongGongKinh' => 'required|integer|min:0',
        ]);

        //dd($request);

        try {
            $g = new ThongSoGong;
            $g->TenCLG = $request->input('TenCLG');
            $g->MauGong = $request->input('MauGong');
            $g->ChieuDaiGongKinh = $request->input('ChieuDaiGongKinh');
            $g->ChieuRongGongKinh = $request->input('ChieuRongGongKinh');
            $g->save();
            session()->flash('success', 'Thông số gòng đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $g = ThongSoGong::findOrFail($id);
        return view('admin.thongsogong.edit', compact('g'));
    }

    public function update(Request $request, $id)
    {
        try {
            $g = ThongSoGong::findOrFail($id);
            $validated = $request->validate([
                'TenCLG' => 'required|string|max:255',
                'MauGong' => 'required|string|max:255',
                'ChieuDaiGongKinh' => 'required|integer|min:0',
                'ChieuRongGongKinh' => 'required|integer|min:0',
            ]);
            $g->update($validated);
            
            session()->flash('success', 'Thông số gòng đã được cập nhật.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $g = ThongSoGong::findOrFail($id);
            $g->delete();
    
            session()->flash('success', 'Thông số gòng đã được xoá.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }
}
