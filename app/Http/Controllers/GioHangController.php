<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\SP_GH;
use App\Models\DS_SP;
use Illuminate\Database\QueryException;
class GioHangController extends Controller
{
    public function index()
    {
        $gh = GioHang::with(['khachHang', 'sanPhams'])->get();
        return view('admin.giohang.review', compact('gh'));
    }

    public function addToCart(Request $request, $MaSP)
    {
        $MaKH = session()->get('MaKH');

        $request->validate(rules: [
            'SoLuongSP' => 'required|integer|min:1',
        ]);

        // Kiểm tra nếu mã khách hàng tồn tại
        if ($MaKH) {
            // Kiểm tra xem khách hàng đã có trong bảng danhsachyeuthich chưa
            $danhSach = GioHang::with([
                'sanPhams' => function ($query) {
                    $query->withTrashed(); // Bao gồm sản phẩm đã bị xoá mềm
                }
            ])->withTrashed()
                ->where('MaKH', $MaKH)
                ->first();
            // Nếu chưa tồn tại, thêm mới
            if (!$danhSach) {
                $danhSach = new GioHang();
                $danhSach->MaKH = $MaKH;
                $danhSach->save(); // Lưu thông tin danh sách yêu thích
            }
            //Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
            $sanPhamTrongDanhSach = SP_GH::where('MaGH', $danhSach->MaGH)->where('MaSP', $MaSP)->first();
            $sanPham = SanPham::where('MaSP', $MaSP)->first();
            if (!$sanPhamTrongDanhSach) {
                // Nếu chưa có, thêm sản phẩm vào danh sách yêu thích
                SP_GH::create([
                    'MaGH' => $danhSach->MaGH, // Lấy mã danh sách yêu thích đã tạo
                    'MaSP' => $MaSP,
                    'SoLuongSP' => $request->input('SoLuongSP'),
                    'DonGia' => $sanPham->GiaBan,
                    'ThanhTien' => $request->input('SoLuongSP') * $sanPham->GiaBan
                ]);
            }

            // Đếm lại số lượng sản phẩm trong danh sách yêu thích
            $sanPhamTrongGH = SP_GH::where('MaGH', $danhSach->MaGH)->count();

            // Trả về phản hồi JSON để AJAX cập nhật giao diện
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng.',
                'addUrl' => route('cart.add', $MaSP),  // URL để thêm lại
                'removeUrl' => route('cart.remove', $MaSP),  // URL để xóa
                'sanPhamTrongGH' => $sanPhamTrongGH
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Vui lòng đăng nhập'
        ]);
    }

    public function checkCart(Request $request)
    {
        $MaSP = $request->input('MaSP');

        $MaKH = session()->get('MaKH');
        // Giả sử bạn sử dụng session hoặc database để lưu giỏ hàng
        //$cart = session()->get('cart', []);
        $sanPhamTrongGH = SP_GH::join('GioHang', 'SP_GH.MaGH', '=', 'GioHang.MaGH')
            ->where('GioHang.MaKH', $MaKH) // Lọc theo MaKH lấy từ session
            ->pluck('SP_GH.MaSP')
            ->toArray();
        //var_dump($sanPhamTrongGH);
        $isInCart = in_array($MaSP, $sanPhamTrongGH);

        return response()->json([
            'isInCart' => $isInCart,
        ]);
    }

    public function review()
    {
        $MaKH = session()->get('MaKH');
        try {
            $soLuongSanPham = [];
            $sanPhamTrongGH = [];
            $sanPham = SP_GH::join('GioHang', 'SP_GH.MaGH', '=', 'GioHang.MaGH')
                ->where('GioHang.MaKH', $MaKH)
                ->select('SP_GH.MaSP', 'SanPham.TenSP', 'SanPham.AnhSP', 'SP_GH.SoLuongSP', 'SP_GH.DonGia', 'SP_GH.ThanhTien')
                ->join('SanPham', 'SP_GH.MaSP', '=', 'SanPham.MaSP') // Thêm thông tin từ bảng SanPham
                ->get();
            if ($MaKH) {

                $danhSach = GioHang::where('MaKH', $MaKH)->first();
                if ($danhSach) {
                    // Lấy mã danh sách yêu thích của khách hàng
                    $maGH = $danhSach->MaGH;
                }
            }

            return view('user.giohang.index', compact('sanPham'));

        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        // Fetch the cart from the session
        // $cart = session()->get('cart', []);

        // return view('user.giohang.index', compact('cart'));
    }

    public function removeItem(Request $request, $MaSP)
    {
        $MaKH = session()->get('MaKH');

        try {
            if ($MaKH) {
                $favoriteList = GioHang::withTrashed()->where('MaKH', $MaKH)->first();

                if ($favoriteList) {
                    $sanPham = SP_GH::where('MaGH', $favoriteList->MaGH)->where('MaSP', $MaSP)->first();

                    if ($sanPham) {
                        $sanPham->delete();
                        // Đếm lại số lượng sản phẩm trong danh sách yêu thích
                        $sanPhamTrongGH = SP_GH::where('MaGH', $favoriteList->MaGH)->count();

                        // Trả về phản hồi JSON để AJAX cập nhật giao diện
                        return response()->json([
                            'success' => true,
                            'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.',
                            'addUrl' => route('cart.add', $MaSP),  // URL để thêm lại
                            'removeUrl' => route('cart.remove', $MaSP),  // URL để xóa
                            'sanPhamTrongGH' => $sanPhamTrongGH
                        ]);
                    } else {
                        // Không tìm thấy sản phẩm trong giỏ hàng
                        session()->flash('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
                        return response()->json([
                            'success' => false,
                            'message' => 'Sản phẩm không tồn tại trong giỏ hàng.'
                        ]);
                    }

                } else {
                    // Không tìm thấy giỏ hàng
                    session()->flash('error', 'Không tìm thấy giỏ hàng.');
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy giỏ hàng.'
                    ]);
                }
            } else {
                // Người dùng chưa đăng nhập
                session()->flash('error', 'Bạn cần đăng nhập để thực hiện thao tác này.');
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn cần đăng nhập để thực hiện thao tác này.'
                ]);
            }
        } catch (QueryException $e) {
            // Xử lý lỗi từ database và gửi thông báo lỗi
            session()->flash('error', 'Lỗi khi xóa sản phẩm khỏi giỏ hàng: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi xóa sản phẩm khỏi giỏ hàng: ' . $e->getMessage()
            ]);
        }
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return response()->json(['count' => $count]);
    }

    public function update(Request $request)
    {
        $MaSP = $request->input('MaSP');
        $newQuantity = $request->input('quantity');
        $MaKH = session()->get('MaKH');

        $gioHang = GioHang::where('MaKH', $MaKH)->first();
        // Tìm sản phẩm trong giỏ hàng và cập nhật số lượng

        if ($gioHang) {
            // Find the cart item in SP_GH using MaSP and MaGH
            $cartItem = SP_GH::where('MaSP', $MaSP)
                ->where('MaGH', $gioHang->MaGH)
                ->first();
            if ($cartItem) {
                $cartItem->SoLuongSP = $newQuantity;

                // Tính lại thành tiền của sản phẩm
                $productTotal = $cartItem->DonGia * $newQuantity;
                $cartItem->ThanhTien = $productTotal;

                $cartItem->save();

                // Tính tổng tiền giỏ hàng
                $cartItems = SP_GH::where('MaGH', $gioHang->MaGH)->get();
                $totalPrice = 0;
                foreach ($cartItems as $item) {
                    $totalPrice += $item->DonGia * $item->SoLuongSP;
                }

                // Trả về dữ liệu mới để cập nhật giao diện
                return response()->json([
                    'productTotalFormatted' => number_format($productTotal, 0, ',', '.'),
                    'totalPriceFormatted' => number_format($totalPrice, 0, ',', '.')
                ]);
            } else {
                return response()->json(['error' => 'Product not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Cart not found'], 404);
        }
    }
}
