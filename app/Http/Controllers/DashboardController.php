<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $userId = session('MaKH');
        if ($userId) {
            $user = KhachHang::where('MaKH', $userId)->first();

            if ($user && $user->TrangThaiTK == 1) {
                // Người dùng đã đăng nhập, tiếp tục xử lý request
                return view("welcome");
            }
            else {
                return view('auth.login');
            }
        }
        else {
            return view('auth.login');
        }
    }
}
