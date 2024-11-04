<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (session()->has('MaKH')) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập hoặc trang khác
            return redirect()->route('index'); // hoặc route('sanpham.index') nếu muốn về trang sản phẩm
        }

        // Nếu đã đăng nhập, tiếp tục xử lý yêu cầu
        return $next($request);
    }
}
