<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class RegisterUserController extends Controller
{
    public function index() {
        $kh = KhachHang::all();
        return view('user.index', compact('kh'));
    }
    public function register(){
        return view('auth.register');
    }
    public function store(Request $request){
        try {
            $input = $request->all();
            
            $kh = new KhachHang;
            $kh->TenKH = $input['name'];
            $kh->MatKhau = Hash::make($input['password']);
            $kh->Email = $input['email'];
            //dd($kh);
            $kh->save();

        }catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        // $request->validate([
        //     'email'=> 'required|email|unique:users',
        //     'password'=> ['required', 'min:8', 'confirmed', Password::defaults()],
        // ]);

        // $user = User::create([
        //     'Email' => $request->email,
        //     'MatKhau' => Hash::make($request->password)
        // ]);

        // auth()->login($user);

        return view('welcome');
    }
}
