<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\KhachHang;
use App\Models\NguoiQuanLy;
use App\Http\Controllers\SanPhamController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DS_SP;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    //protected $redirectTo = '/home';
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',            // Mật khẩu ít nhất 8 ký tự
                'regex:/[a-z]/',    // Ít nhất một chữ thường
                'regex:/[A-Z]/',    // Ít nhất một chữ hoa
                'regex:/[0-9]/',    // Ít nhất một số
                'regex:/[@$!%*?&#]/', // Ít nhất một ký tự đặc biệt
            ],
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
                
                return redirect()->action([SanPhamController::class, 'index']);
            }
            else {
                return response()->json(['message'=>'Email user hoac mat khau khong dung'], 401);
            }
        }
        else {
            if ($ql && Hash::check($password, $ql->MatKhau)) {
                $ql->TrangThaiTaiKhoan = 1;
                //dd($kh);
                $ql->save();
                session(['MaQL' => $ql->MaQL, 'TenQL' => $ql->TenQL]);
                return view('admin.index', compact('ql'));
            }
            else {
                return response()->json(['message'=>'Email admin hoac mat khau khong dung'], 401);
            }
        }
    }

    public function logout(Request $request)
    {
        if (session()->has('MaKH')) {
            // Nếu người dùng là KhachHang
            $kh = KhachHang::where('MaKH', session('MaKH'))->first();
            if ($kh) {
                // Đặt trạng thái tài khoản thành 0
                $kh->TrangThaiTK = 0;
                $kh->save();
            }
            // Xóa session
            session()->forget(['MaKH', 'TenKH']);
        } elseif (session()->has('MaQL')) {
            // Nếu người dùng là NguoiQuanLy
            $ql = NguoiQuanLy::where('MaQL', session('MaQL'))->first();
            if ($ql) {
                // Đặt trạng thái tài khoản thành 0
                $ql->TrangThaiTaiKhoan = 0;
                $ql->save();
            }
            // Xóa session
            session()->forget(['MaQL', 'TenQL']);
        }

        // Xóa tất cả session (tùy chọn)
        session()->flush();

        // Chuyển hướng về trang đăng nhập
        return redirect('/')->with('message', 'Đăng xuất thành công');
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->middleware('auth')->only('logout');
    }

    // Phương thức authenticated sau khi đăng nhập thành công
    protected function authenticated(Request $request, $user)
    {
        // Kiểm tra người dùng là khách hàng hay quản lý để chuyển hướng
        if (session()->has('MaKH')) {
            return redirect()->action([SanPhamController::class, 'index']);
        } elseif (session()->has('MaQL')) {
            return redirect()->route('admin.index');
        }
    }
    public function index(){
        return view('auth.login');
    }
}
