<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu session không có MaKH
        if (!session()->has('MaKH')) {
            // Chuyển hướng về trang chủ hoặc trang đăng nhập
            return redirect()->route('/'); // Hoặc route('login')
        }

        return $next($request);
    }
}
