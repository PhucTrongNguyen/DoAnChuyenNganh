<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\SP_DH;

class DonHangController extends Controller
{
    //
    public function index()
    {
        if (session()->has('MaKH')) {
            $MaKH = session()->get('MaKH');

            // Lấy tất cả đơn hàng của khách hàng (bao gồm cả đơn hàng đã bị xoá mềm)
            $dh = DonHang::with([
                'sanPhams' => function ($query) {
                    $query->withTrashed(); // Bao gồm sản phẩm đã bị xoá mềm
                }
            ])
                ->withTrashed() // Bao gồm đơn hàng đã bị xoá mềm
                ->where('MaKH', $MaKH)
                ->get();

            // Kiểm tra từng đơn hàng và cập nhật trạng thái nếu không còn sản phẩm
            foreach ($dh as $donHang) {
                $remainingProducts = SP_DH::where('MaDH', $donHang->MaDH)->count();

                if ($remainingProducts == 0 && $donHang->TrangThaiDonHang !== 'Đã huỷ') {
                    // Nếu không còn sản phẩm và trạng thái chưa phải là "Đã huỷ"
                    $donHang->TrangThaiDonHang = 'Đã huỷ';
                    $donHang->save();

                    // Xoá mềm đơn hàng (soft delete)
                    $donHang->delete();
                }
            }

            return view('user.donhang.index', compact('dh'));
        } elseif (session()->has('MaQL')) {
            $dh = DonHang::with([
                'sanPhams' => function ($query) {
                    $query->withTrashed();
                }
            ])
                ->withTrashed() // Bao gồm cả đơn hàng đã xoá mềm
                ->get();
            return view('admin.donhang.review', compact('dh'));
        }

    }

    public function destroy(Request $request, $donHang, $sanPham)
    {
        $MaKH = session()->get('MaKH');
        //dd($MaKH);
        try {
            if ($MaKH) {
                // Lấy đơn hàng của khách hàng hiện tại
                $cart = DonHang::with([
                    'sanPhams' => function ($query) {
                        $query->withTrashed(); // Bao gồm sản phẩm đã bị xoá mềm
                    }
                ])->withTrashed() // Bao gồm cả đơn hàng đã xoá mềm
                    ->where('MaKH', $MaKH)
                    ->where('MaDH', $donHang) // Chỉ lấy đơn hàng đang cần xoá sản phẩm
                    ->first();

                if ($cart) {
                    // Xoá sản phẩm khỏi đơn hàng
                    SP_DH::where('MaDH', $donHang)->where('MaSP', $sanPham)->delete();

                    // Kiểm tra xem còn sản phẩm nào trong đơn hàng không
                    $remainingProducts = SP_DH::where('MaDH', $donHang)->count();

                    if ($remainingProducts == 0) {
                        // Nếu không còn sản phẩm, cập nhật trạng thái đơn hàng thành "Huỷ"
                        $cart->TrangThaiDonHang = 'Đã huỷ';
                        $cart->save();

                        // Xoá mềm đơn hàng (soft delete)
                        $cart->delete();

                        // Thông báo huỷ đơn hàng
                        session()->flash('success', 'Đơn hàng đã bị huỷ do không còn sản phẩm nào.');
                    } else {
                        // Thông báo sản phẩm đã được xoá khỏi đơn hàng
                        session()->flash('success', 'Sản phẩm trong đơn hàng đã được xoá.');
                    }
                } else {
                    // Nếu không tìm thấy đơn hàng
                    session()->flash('error', 'Không tìm thấy đơn hàng.');
                }
                // Trả về danh sách đơn hàng của khách hàng (bao gồm cả đơn hàng đã xoá mềm)
                $dh = DonHang::with([
                    'sanPhams' => function ($query) {
                        $query->withTrashed(); // Bao gồm sản phẩm đã bị xoá mềm
                    }
                ])
                    ->withTrashed() // Bao gồm cả đơn hàng đã xoá mềm
                    ->where('MaKH', $MaKH)
                    ->get();

                // Redirect về trang giỏ hàng
                // return redirect()->route('donhang.index')->with([
                //     'dh' => $dh,
                // ])->withTrashed() // Bao gồm cả đơn hàng đã xoá mềm
                // ->get();;
                return response()->json([
                    'success' => true,
                    'message' => 'Sản phẩm đã được xóa khỏi đơn hàng.'
                ]);
            }
            // Trường hợp không tìm thấy giỏ hàng hoặc sản phẩm
            session()->flash('error', 'Không tìm thấy đơn hàng hoặc sản phẩm.');
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng hoặc sản phẩm.'
            ]);
        } catch (QueryException $e) {
            // Lưu thông báo lỗi vào session
            session()->flash('error', 'Lỗi khi xóa sản phẩm khỏi đơn hàng: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi xóa sản phẩm khỏi đơn hàng:' . $e->getMessage()
            ]);
        }
    }

    public function checkOrder(Request $request)
    {
        $MaSP = $request->input('MaSP');

        $MaKH = session()->get('MaKH');
        // Giả sử bạn sử dụng session hoặc database để lưu giỏ hàng
        //$cart = session()->get('cart', []);
        $sanPhamTrongDH = SP_DH::join('DonHang', 'SP_DH.MaDH', '=', 'DonHang.MaDH')
            ->where('DonHang.MaKH', $MaKH) // Lọc theo MaKH lấy từ session
            ->pluck('SP_DH.MaSP')
            ->toArray();
        //var_dump($sanPhamTrongGH);
        $isInOrder = in_array($MaSP, $sanPhamTrongDH);

        return response()->json([
            'isInOrder' => $isInOrder,
        ]);
    }

    public function cancel(Request $request)
    {
        $MaKH = session()->get('MaKH');
        $donHangs = DonHang::with([
            'sanPhams' => function ($query) {
                $query->withTrashed(); // Bao gồm sản phẩm đã bị xoá mềm
            }
        ])->withTrashed() // Bao gồm cả đơn hàng đã xoá mềm
            ->where('MaKH', $MaKH)
            ->get();
        try {
            if ($MaKH) {
                if ($donHangs->isEmpty()) {
                    // Trường hợp không có đơn hàng nào
                    session()->flash('error', 'Không tìm thấy đơn hàng nào để hủy.');
                    return redirect()->route('donhang.index');
                }

                // Duyệt qua tất cả các đơn hàng của khách hàng
                foreach ($donHangs as $donHang) {
                    // Cập nhật trạng thái đơn hàng thành "Đã hủy"
                    $donHang->TrangThaiDonHang = 'Đã hủy';
                    $donHang->save();

                    // Xóa mềm đơn hàng (nếu cần dùng soft delete)
                    $donHang->delete();
                }

                // Thông báo thành công
                session()->flash('success', 'Tất cả đơn hàng của bạn đã được hủy thành công.');

                // Chuyển hướng về trang danh sách đơn hàng
                return redirect()->route('donhang.index')->with([
                    'dh' => $donHangs,
                ]);
            }
            // Trường hợp không tìm thấy giỏ hàng hoặc sản phẩm
            session()->flash('error', 'Không tìm thấy đơn hàng hoặc sản phẩm.');
            return redirect()->route('donhang.index')->with([
                'dh' => $donHangs,
            ]);
        } catch (QueryException $e) {
            // Lưu thông báo lỗi vào session
            session()->flash('error', 'Lỗi khi xóa sản phẩm khỏi đơn hàng: ' . $e->getMessage());
            return redirect()->route('donhang.index')->with([
                'dh' => $donHangs,
            ]);
        }
    }

    public function bulkOrder(Request $request)
    {
        $MaKH = session()->get('MaKH'); // Lấy mã khách hàng từ session
        $selectedOrders = json_decode($request->input('selectedOrders'), true); // Lấy danh sách đơn hàng đã chọn từ input ẩn

        //dd($selectedOrders);
        if ($selectedOrders && $MaKH) {
            try {
                foreach ($selectedOrders as $item) {
                    // Lấy đơn hàng theo mã đơn hàng (MaDH) và mã khách hàng (MaKH)
                    $donHang = DonHang::with([
                        'sanPhams' => function ($query) {
                            $query->withTrashed(); // Bao gồm sản phẩm đã bị xóa mềm
                        }
                    ])->where('MaKH', $MaKH)
                        ->where('MaDH', $item['id']) // Lọc theo mã đơn hàng
                        ->first();

                    if ($donHang) {
                        // Cập nhật trạng thái đơn hàng thành 'Đã hủy'
                        $donHang->TrangThaiDonHang = 'Đã hủy';
                        $donHang->save();

                        // Xóa mềm đơn hàng (nếu sử dụng soft delete)
                        $donHang->delete();
                    }
                }
                // Sau khi huỷ đơn hàng, tải lại danh sách đơn hàng còn lại
                $donHangs = DonHang::with(['sanPhams'])
                ->withTrashed()
                ->where('MaKH', $MaKH)
                ->get();

                // Thông báo thành công
                session()->flash('success', 'Các đơn hàng đã được hủy thành công.');

                // Chuyển hướng về trang danh sách đơn hàng và truyền biến dh
                return redirect()->route('donhang.index')->with('dh', $donHangs);

            } catch (QueryException $e) {
                // Xử lý lỗi truy vấn
                session()->flash('error', 'Lỗi khi hủy đơn hàng: ' . $e->getMessage());
            }
        } else {
            session()->flash('error', 'Không tìm thấy đơn hàng hoặc khách hàng.');
        }

        // Chuyển hướng về trang danh sách đơn hàng
        return redirect()->route('donhang.index');
    }

    public function updateStatus(Request $request, $MaDH)
{
    try {
        // Tìm đơn hàng theo Mã đơn hàng (MaDH)
        $donHang = DonHang::withTrashed()->where('MaDH', $MaDH)->first();

        // Kiểm tra nếu đơn hàng tồn tại
        if ($donHang) {
            // Cập nhật trạng thái đơn hàng
            $donHang->TrangThaiDonHang = $request->input('TrangThaiDonHang');
            $donHang->save(); // Lưu thay đổi

            // Thông báo thành công
            return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
        } else {
            // Nếu không tìm thấy đơn hàng
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
        }
    } catch (QueryException $e) {
        // Xử lý lỗi (nếu có)
        return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật trạng thái: ' . $e->getMessage());
    }
}

}
