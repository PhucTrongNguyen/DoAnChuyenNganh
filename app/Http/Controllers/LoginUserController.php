<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use App\Models\NguoiQuanLy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\DS_SP;

class LoginUserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    protected function authenticated(Request $request, $user)
    {
        // Chuyển hướng tới hàm index trong SanPhamController
        return redirect()->action([SanPhamController::class, 'index']);
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');

        $ql = NguoiQuanLy::where('Email', $email)->first();
        //dd($ql);
        if (!$ql) {
            $kh = KhachHang::where('Email', $email)->first();
            if ($kh && Hash::check($password, $kh->MatKhau)) {
                //KhachHang::where('MaKH', $kh->MaKH)::update(['TrangThaiTK' => 1]);
                $kh->TrangThaiTK = 1;
                //dd($kh);
                $kh->save();
                session(['MaKH' => $kh->MaKH, 'TenKH' => $kh->TenKH]);
                $kh = KhachHang::with("diaChis")->where("MaKH", $kh->MaKH)->first();
                // Kiểm tra nếu người dùng đã đăng nhập và có danh sách yêu thích
                $favoriteCount = DS_SP::whereHas('danhsachyeuthich', function ($query) use ($kh) {
                    $query->where('MaKH', $kh->MaKH);
                })->count(); // Đếm số lượng sản phẩm yêu thích
                return response()->json(['message' => 'Đăng nhập thành công', 'kh' => $kh, 'favoriteCount' => $favoriteCount]);
                //return view('user.sanpham.index', compact('sp'));
            } else {
                return response()->json(['message' => 'Email user hoac mat khau khong dung'], 401);
            }
        } else {
            if ($ql && Hash::check($password, $ql->MatKhau)) {
                //KhachHang::where('MaKH', $kh->MaKH)::update(['TrangThaiTK' => 1]);
                $ql->TrangThaiTaiKhoan = 1;
                //dd($kh);
                $ql->save();
                session(['MaQL' => $ql->MaQL, 'TenQL' => $ql->TenQL]);
                //dd($kh);
                //return response()->json(['message'=>'Đăng nhập thành công', 'kh' => $kh]);
                return view('admin.index', compact('ql'));
            } else {
                return response()->json(['message' => 'Email admin hoac mat khau khong dung'], 401);
            }
        }
    }

}
