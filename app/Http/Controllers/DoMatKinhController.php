<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoMatKinh;
use Illuminate\Database\QueryException;

class DoMatKinhController extends Controller
{
    public function index(){
        $dmk = DoMatKinh::all();
        
        return view("admin.domatkinhh.review", compact("dmk"));
    }
    public function create()
    {
        return view('admin.domatkinh.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'DoMatTrai' => ['required', 'numeric', 'between:0,10', 'regex:/^\d+(\.\d{1,2})?$/'],
            'DoMatPhai' => ['required', 'numeric', 'between:0,10', 'regex:/^\d+(\.\d{1,2})?$/']
        ], [
            'DoMatTrai.regex' => 'Độ mắt trái phải là số thập phân và có tối đa 2 chữ số sau dấu chấm.',
            'DoMatPhai.regex' => 'Độ mắt phải phải là số thập phân và có tối đa 2 chữ số sau dấu chấm.',
            'DoMatTrai.between' => 'Độ mắt trái phải nằm trong khoảng 0 đến 10.',
            'DoMatPhai.between' => 'Độ mắt phải phải nằm trong khoảng 0 đến 10.'
        ]);
        //dd($request);

        try {
            $dmk = new DoMatKinh;
            $dmk->DoMatTrai = $request->input('DoMatTrai');
            $dmk->DoMatPhai = $request->input('DoMatPhai');
            $dmk->save();
            session()->flash('success', 'Độ mắt kính đã được lưu thành công.');
            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $dmk = DoMatKinh::findOrFail($id);
        return view('admin.domatkinh.edit', compact('dmk'));
    }
    public function update(Request $request, $id)
    {
        try {
            $dmk = DoMatKinh::findOrFail($id);
            $validated = $request->validate([
                'DoMatTrai' => ['required', 'numeric', 'between:0,10', 'regex:/^\d+(\.\d{1,2})?$/'],
                'DoMatPhai' => ['required', 'numeric', 'between:0,10', 'regex:/^\d+(\.\d{1,2})?$/']
            ], [
                'DoMatTrai.regex' => 'Độ mắt trái phải là số thập phân và có tối đa 2 chữ số sau dấu chấm.',
                'DoMatPhai.regex' => 'Độ mắt phải phải là số thập phân và có tối đa 2 chữ số sau dấu chấm.',
                'DoMatTrai.between' => 'Độ mắt trái phải nằm trong khoảng 0 đến 10.',
                'DoMatPhai.between' => 'Độ mắt phải phải nằm trong khoảng 0 đến 10.'
            ]);
            $dmk->update($validated);
    
            session()->flash('success', 'Độ mắt kính đã được cập nhật.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $dmk = DoMatKinh::findOrFail($id);
            $dmk->delete();
    
            session()->flash('success', 'Độ mắt kính đã được xoá.');
            return redirect()->back();
        }catch(QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }
}
