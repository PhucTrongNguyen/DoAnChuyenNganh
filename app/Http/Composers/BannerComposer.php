<?php

namespace App\Http\Composers;

use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use App\Models\DS_SP;
use App\Models\SP_GH;

class BannerComposer
{
    public function compose(View $view)
    {
        // Lấy tất cả các file ảnh trong thư mục public/banners
        $banners = File::files(public_path('banners'));

        if (session()->has('MaKH')) {
            $kh = session()->get('MaKH');
    
            // Lấy số lượng sản phẩm yêu thích của khách hàng
            $soLuongSanPham = DS_SP::join('DanhSachYeuThich', 'DS_SP.MaDS', '=', 'DanhSachYeuThich.MaDS')
                ->where('DanhSachYeuThich.MaKH', $kh)
                ->pluck('DS_SP.MaSP')
                ->toArray();
            
            // Lấy danh sách sản phẩm trong giỏ hàng của khách hàng
            $sanPhamTrongGH = SP_GH::join('GioHang', 'SP_GH.MaGH', '=', 'GioHang.MaGH')
                ->where('GioHang.MaKH', $kh)
                ->pluck('SP_GH.MaSP')
                ->toArray();
           
            // Chia sẻ dữ liệu banners, soLuongSanPham, sanPhamTrongGH với view nếu đã đăng nhập
            $view->with([
                'banners' => $banners,
                'soLuongSanPham' => $soLuongSanPham,
                'sanPhamTrongGH' => $sanPhamTrongGH
            ]);
        } else {
            // Chia sẻ chỉ dữ liệu banners nếu chưa đăng nhập
            $view->with('banners', $banners);
        }
    }
}
