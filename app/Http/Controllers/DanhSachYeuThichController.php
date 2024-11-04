<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhSachYeuThich;
use App\Models\SanPham;
use App\Models\DS_SP;
use App\Models\SP_GH;
use Illuminate\Database\QueryException;

class DanhSachYeuThichController extends Controller
{
    public function index()
    {
        $ds = DanhSachYeuThich::with(['khachHang', 'sanPhams'])->get();
        return view("admin.danhsachyeuthich.review", compact('ds'));
    }

    public function addFavorite(Request $request, $MaSP)
    {
        $MaKH = session()->get('MaKH');

        // Kiểm tra nếu mã khách hàng tồn tại
        if ($MaKH) {
            // Kiểm tra xem khách hàng đã có trong bảng danhsachyeuthich chưa
            $danhSach = DanhSachYeuThich::where('MaKH', $MaKH)->first();

            // Nếu chưa tồn tại, thêm mới
            if (!$danhSach) {
                $danhSach = new DanhSachYeuThich();
                $danhSach->MaKH = $MaKH;
                $danhSach->save(); // Lưu thông tin danh sách yêu thích
            }
            //Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
            $sanPhamTrongDanhSach = DS_SP::where('MaDS', $danhSach->MaDS)->where('MaSP', $request->input('MaSP'))->first();

            if (!$sanPhamTrongDanhSach) {
                // Nếu chưa có, thêm sản phẩm vào danh sách yêu thích
                DS_SP::create([
                    'MaDS' => $danhSach->MaDS, // Lấy mã danh sách yêu thích đã tạo
                    'MaSP' => $MaSP,
                ]);
            }

            // Đếm lại số lượng sản phẩm trong danh sách yêu thích
            $soLuongSanPham = DS_SP::where('MaDS', $danhSach->MaDS)->count();

            // Trả về phản hồi JSON để AJAX cập nhật giao diện
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào danh sách yêu thích.',
                'addUrl' => route('favorite.add', $MaSP),  // URL để thêm lại
                'removeUrl' => route('favorite.remove', $MaSP),  // URL để xóa
                'soLuongSanPham' => $soLuongSanPham
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Vui lòng đăng nhập'
        ]);
        
    }

    public function removeFavorite(Request $request,$MaSP)
    {
        $MaKH = session()->get('MaKH');

        if ($MaKH) {
            $favoriteList = DanhSachYeuThich::where('MaKH', $MaKH)->first();

            if ($favoriteList) {
                DS_SP::where('MaDS', $favoriteList->MaDS)->where('MaSP', $MaSP)->delete();

                // Đếm lại số lượng sản phẩm trong danh sách yêu thích
                $soLuongSanPham = DS_SP::where('MaDS', $favoriteList->MaDS)->count();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích.',
                    'addUrl' => route('favorite.add', $MaSP),  // URL để thêm lại
                    'removeUrl' => route('favorite.remove', $MaSP),  // URL để xóa
                    'soLuongSanPham' => $soLuongSanPham
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy danh sách yêu thích.'
        ]);
        
    }

    public function review()
    {
        $MaKH = session()->get('MaKH');
        try {
            $soLuongSanPham = [];
            $sanPhamTrongGH = [];
            if ($MaKH) {
                $danhSach = DanhSachYeuThich::where('MaKH', $MaKH)->first();
                if ($danhSach) {
                    // Lấy mã danh sách yêu thích của khách hàng
                    $maDS = $danhSach->MaDS;
                    // Đếm số lượng sản phẩm có trong danh sách yêu thích của khách hàng
                    $soLuongSanPham = DS_SP::join('DanhSachYeuThich', 'DS_SP.MaDS', '=', 'DanhSachYeuThich.MaDS')
                        ->where('DanhSachYeuThich.MaKH', $MaKH) // Lọc theo MaKH lấy từ session
                        ->pluck('DS_SP.MaSP')
                        ->toArray();
                    $sanPhamTrongGH = SP_GH::join('GioHang', 'SP_GH.MaGH', '=', 'GioHang.MaGH')
                        ->where('GioHang.MaKH', $MaKH) // Lọc theo MaKH lấy từ session
                        ->pluck('SP_GH.MaSP')
                        ->toArray();
                    // $soLuongSanPham = DS_SP::where('danhsachyeuthich', function ($query) use ($MaKH) {
                    //     $query->where('MaKH', $MaKH); })->pluck('MaSP')->toArray();

                }
            }
            return view('user.danhsachyeuthich.index', compact('soLuongSanPham', 'sanPhamTrongGH'));

        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function checkFavorites(Request $request) {
        $MaSP = $request->input('MaSP');
        
        $MaKH = session()->get('MaKH');
        // Giả sử bạn sử dụng session hoặc database để lưu giỏ hàng
        //$cart = session()->get('cart', []);
        $sanPhamTrongDS = DS_SP::join('DanhSachYeuThich', 'DS_SP.MaDS', '=', 'DanhSachYeuThich.MaDS')
                ->where('DanhSachYeuThich.MaKH', $MaKH) // Lọc theo MaKH lấy từ session
                ->pluck('DS_SP.MaSP')
                ->toArray();
        //var_dump($sanPhamTrongGH);
        $isInFavorite = in_array($MaSP, $sanPhamTrongDS);
        
        return response()->json([
            'isInFavorite' => $isInFavorite,
        ]);
    }
}
