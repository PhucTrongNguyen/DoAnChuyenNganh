<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\SP_GH;
use App\Models\GioHang;
use App\Models\NguoiQuanLy;
use App\Models\DonHang;
use App\Models\SP_DH;
use Illuminate\Database\QueryException;

class CheckoutController extends Controller
{
    public function checkoutPayment(Request $request)
    {
        // $soLuongSanPham = [];
        // $sanPhamTrongGH = [];
        $total = 0;
        $MaKH = session()->get('MaKH');
        $gioHang = GioHang::withTrashed()->where('MaKH', $MaKH)->first();

        if (!$gioHang) {
            return redirect()->back()->with('error', 'Giỏ hàng không tồn tại');
        }

        // Lấy tất cả sản phẩm trong giỏ hàng của khách hàng
        $cartItems = SP_GH::where('MaGH', $gioHang->MaGH)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn trống');
        }

        // Tính tổng tiền cho tất cả các sản phẩm trong giỏ hàng
        foreach ($cartItems as $item) {
            $itemTotal = $item->DonGia * $item->SoLuongSP;
            $total += $itemTotal;
        }
        $sanPham = SP_GH::join('GioHang', 'SP_GH.MaGH', '=', 'GioHang.MaGH')
                        ->where('GioHang.MaKH', $MaKH)
                        ->select('SP_GH.MaSP', 'SanPham.TenSP', 'SanPham.AnhSP', 'SP_GH.SoLuongSP', 'SP_GH.DonGia', 'SP_GH.ThanhTien')
                        ->join('SanPham', 'SP_GH.MaSP', '=', 'SanPham.MaSP') // Thêm thông tin từ bảng SanPham
                        ->get();

        $acc = config('session.acc');
        $bank = config('session.bank');
        $des = 'MLB1'; //'sanPhamTrongGH', 'soLuongSanPham', 'sanPham'
        return view('user.thanhtoan.order_payment', [
            'img' => "https://qr.sepay.vn/img?acc=$acc&bank=$bank&amount=$total&des=$des",
            'total' => $total,
            'cart' => $sanPham,
            'bank_name' => 'Ngân hàng TMCP Kỹ thương Việt Nam',
        ]);
    }

    public function paymentComplete(Request $request)
    {
        try {
            $paymentMethod = $request->input('payment_method');
            
            $user = session()->get('MaKH'); // Get customer ID
    
            // Validate request if necessary
            $validated = $request->validate([
                'payment_method' => 'required', // Validate payment method (cash or QR)
                'products' => 'required|array',
                'products.*.id' => 'required|string',
                // 'products.*.name' => 'required|string',
                'products.*.quantity' => 'required|integer',
                'products.*.price' => 'required',
            ]);

            // Retrieve payment method
            $paymentMethod = $validated['payment_method'];

            // Retrieve products
            $products = $validated['products'];
    
            // Get the manager (MaQL) with ChucVu "Quản lý"
            $maQL = NguoiQuanLy::where('ChucVu', 'Quản lý')->first()->MaQL;
    
            // Create the order in donhang table
            if ($request->payment_method == 'QR') {
                $order = DonHang::create([
                    'MaKH' => $user,
                    'MaQL' => $maQL,
                    'PTThanhToan' => $paymentMethod,
                    'TrangThaiDonHang' => 'Chờ vận chuyển', // Default status
                ]);
            } else {
                $order = new DonHang();
                $order->MaKH = $user;
                $order->MaQL = $maQL;
                $order->PTThanhToan = $paymentMethod;
                $order->TrangThaiDonHang = 'Chờ vận chuyển';
                $order->save();
            }
            $lastOrder = DonHang::withTrashed()->orderBy('MaDH', 'desc')->first();
            
            // Save each product from the cart into SP_DH table
            foreach ($products as $product) {
                //dd($product['quantity']);
                SP_DH::create([
                    'MaDH' => $lastOrder->MaDH,       // Order ID
                    'MaSP' => $product['id'],        // Product ID
                    'SoLuongSP' => $product['quantity'],  // Quantity
                    'DonGia' => $product['price'],    // Unit price
                    'ThanhTien' => $product['quantity'] * $product['price'],  // Total price for the item
                ]);
            }
            $cart = GioHang::withTrashed()->where('MaKH', $user)->first();
            // Remove each product from the order into SP_DH table
            foreach ($products as $product) {
                //dd($product['quantity']);
                SP_GH::where('MaGH', $cart->MaGH)->where('MaSP', $product['id'])->delete();
            }
            $cart->delete();
            
            return redirect()->route('checkout.success');
            //return view('user.thanhtoan.payment_complete');
            
        } catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

    public function index(Request $request)
    {
        $user = session()->get('MaKH'); // Get customer ID
        
        return view('user.thanhtoan.payment_complete')->with('success', 'Đặt hàng thành công!');
    }

    public function bulkPayment(Request $request)
    {
        $total = 0;
        $selectedProducts = json_decode($request->input('selectedProducts'), true);
        // Xử lý thanh toán cho các sản phẩm đã chọn
        //dd($selectedProducts);
        
        foreach ($selectedProducts as $item) {
            $product = SanPham::where('MaSP', $item)->first();

            if ($product) {
                // Giả sử số lượng sản phẩm nằm trong session hoặc có thể mặc định là 1
                $quantity = $item['quantity'];

                // Tính tổng cho sản phẩm hiện tại
                $itemTotal = $product->GiaBan * $quantity;
                $total += $itemTotal;

                // Thêm sản phẩm vào mảng cart
                $cart[] = [
                    'MaSP' => $product->MaSP,
                    'TenSP' => $product->TenSP,
                    'DonGia' => $product->GiaBan,
                    'SoLuongSP' => $quantity,
                    'AnhSP' => $product->AnhSP, // Hình ảnh sản phẩm
                    'itemTotal' => $itemTotal,  // Tổng giá sản phẩm
                ];
            }
        }

        $acc = config('session.acc');
        $bank = config('session.bank');
        $des = 'MLB1';
        return view('user.thanhtoan.order_payment', [
            'img' => "https://qr.sepay.vn/img?acc=$acc&bank=$bank&amount=$total&des=$des",
            'total' => $total,
            'cart' => $cart,
            'bank_name' => 'Ngân hàng TMCP Kỹ thương Việt Nam'
        ]);
    }

}
