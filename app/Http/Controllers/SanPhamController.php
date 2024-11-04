<?php

namespace App\Http\Controllers;

use App\Models\NguoiQuanLy;
use Illuminate\Http\Request;
use App\Models\LoaiMatKinh;
use App\Models\SanPham;
use App\Models\ThongTinKhuyenMai;
use App\Models\ThuongHieu;
use App\Models\ThongSoGong;
use App\Models\ThongSoTrong;
use App\Models\NhaCungCap;
use App\Models\DS_SP;
use App\Models\SP_GH;
use App\Models\DoMatKinh;
use Illuminate\Database\QueryException;

class SanPhamController extends Controller
{
    //
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'feat'); // Lấy tab hiện tại, mặc định là 'feat'
        $page = $request->get('page', 1);    // Lấy trang hiện tại, mặc định là 1
        //dd($page);
        // Lấy sản phẩm theo tab
        if ($tab == 'feat') {
            $sp = SanPham::with('loaiSanPham')->paginate(6, ['*'], 'page', $page);
        } elseif ($tab == 'sale') {
            // Logic cho tab sale
            $sp = SanPham::with('loaiSanPham')->paginate(6, ['*'], 'page', $page); // Ví dụ
        } elseif ($tab == 'best') {
            // Logic cho tab best
            $sp = SanPham::with('loaiSanPham')->paginate(6, ['*'], 'page', $page); // Ví dụ
        }
        //dd($sp);
        $hot = SanPham::all();
        if (session()->has('MaKH')) {
            $kh = session()->get('MaKH');
            if ($request->ajax()) {
                return view("user.sanpham.product-list", compact('sp', 'hot'))->render();
            }
            //$sp = SanPham::with('loaiSanPham')->paginate(3);
            return view("user.sanpham.index", compact('sp', 'tab', 'hot'));
        } elseif (session()->has('MaQL')) {
            $ql = NguoiQuanLy::where('MaQL', session()->get('MaQL'))->first();
            $sp = SanPham::with('loaiSanPham')->get();
            return view("admin.sanpham.review", compact('sp', 'ql'));
        }
        
        if ($request->ajax()) {
            return view("user.sanpham.product-list", compact('sp', 'hot'))->render();
        }
        $kh = session()->has('MaKH') ? session()->get('MaKH') : null;
        return view("user.sanpham.index", compact('sp', 'tab', 'hot'));
    }

    public function getproductinfo($id)
    {
        $sp = SanPham::find($id);

        if (!$sp) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Trả về thông tin sản phẩm dưới dạng JSON
        return response()->json([
            'TenSP' => $sp->TenSP,
            'MoTaChiTiet' => $sp->MoTaChiTiet,
            'GiaBan' => $sp->GiaBan,
            'LoaiSP' => $sp->loaiSanPham->TenLoai,
            'TrangThaiSP' => $sp->TrangThaiSP,
            'AnhSP' => asset($sp->AnhSP) // Đường dẫn tới ảnh sản phẩm
        ]);
    }

    public function create()
    {
        $th = ThuongHieu::all();
        $tsg = ThongSoGong::all();
        $tst = ThongSoTrong::all();
        $lmk = LoaiMatKinh::all();
        $ncc = NhaCungCap::all();
        $km = ThongTinKhuyenMai::all();
        $do = DoMatKinh::all();
        return view('admin.sanpham.create', compact('th', 'tsg', 'tst', 'lmk', 'ncc', 'km', 'do'));
    }

    public function store(Request $request)
    {
        $request->validate(rules: [
            'TenSP' => 'required|string|max:255',
            'GioiTinh' => 'required|in:Nam,Nữ,Unisex',
            'ThuongHieu' => 'required|string|max:255',
            'LoaiMatKinh' => 'required|string|max:255',
            'GiaBan' => 'required|numeric|min:0',
            'SoLuongTonKho' => 'required|integer|min:0',
            'MoTaChiTiet' => 'nullable|string',
            'MaCLG' => 'required|exists:ThongSoGong,MaCLG',
            'MaCLT' => 'required|exists:ThongSoTrong,MaCLT',
            'AnhSP' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'TrangThaiSP' => 'required|in:Có hàng, Chưa có hàng',
            'MaNCC' => 'required|exists:NhaCungCap,MaNCC',
        ]);

        try {
            if ($request->hasFile('AnhSP')) {
                // Lưu file vào thư mục public/uploads
                $fileName = time() . '.' . $request->AnhSP->getClientOriginalExtension();
                $request->AnhSP->move(public_path('uploads'), $fileName);

                // Lưu thông tin sản phẩm vào cơ sở dữ liệu
                $sanpham = new SanPham;
                $sanpham->TenSP = $request->input('TenSP');
                $sanpham->AnhSP = 'uploads/' . $fileName; // Lưu đường dẫn hình ảnh
                $sanpham->GioiTinh = $request->input('GioiTinh');
                $sanpham->ThuongHieu = $request->input('ThuongHieu');
                $sanpham->LoaiMatKinh = $request->input('LoaiMatKinh');
                $sanpham->GiaBan = $request->input('GiaBan');
                $sanpham->SoLuongTonKho = $request->input('SoLuongTonKho');
                $sanpham->MoTaChiTiet = $request->input('MoTaChiTiet');
                $sanpham->MaCLG = $request->input('MaCLG');
                $sanpham->MaCLT = $request->input('MaCLT');
                $sanpham->TrangThaiSP = $request->input('TrangThaiSP');
                $sanpham->MaNCC = $request->input('MaNCC');
                $sanpham->save();

                // Thông báo thành công
                session()->flash('success', 'Sản phẩm đã được lưu thành công.');
                return redirect()->back();
            }
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function generateMaSP()
    {
        // Lấy sản phẩm cuối cùng để tạo mã mới
        $lastProduct = SanPham::orderBy('MaSP', 'desc')->first();

        // Nếu chưa có sản phẩm nào, bắt đầu từ SP01
        if (!$lastProduct) {
            return 'SP01';
        }
        return $lastProduct;
    }

    public function edit($id)
    {
        $sanPham = SanPham::findOrFail($id);
        $th = ThuongHieu::all();
        $tsg = ThongSoGong::all();
        $tst = ThongSoTrong::all();
        $lmk = LoaiMatKinh::all();
        $ncc = NhaCungCap::all();
        $km = ThongTinKhuyenMai::all();
        $do = DoMatKinh::all();
        //dd($sanPham);
        return view('admin.sanpham.edit', compact('sanPham', 'th', 'tsg', 'tst', 'lmk', 'ncc', 'km', 'do'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'TenSP' => 'required|string|max:255',
            'GioiTinh' => 'required|in:Nam,Nữ,Unisex',
            'Do' => 'required|string|max:255',
            'ThuongHieu' => 'required|string|max:255',
            'LoaiMatKinh' => 'required|string|max:255',
            'GiaBan' => 'required|numeric|min:0',
            'SoLuongTonKho' => 'required|integer|min:0',
            'MoTaChiTiet' => 'nullable|string',
            'MaCLG' => 'required|exists:ThongSoGong,MaCLG',
            'MaCLT' => 'required|exists:ThongSoTrong,MaCLT',
            'AnhSP' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'TrangThaiSP' => 'required|in:Có hàng, Chưa có hàng',
            'MaNCC' => 'required|exists:NhaCungCap,MaNCC',
        ]);

        try {
            // Tìm sản phẩm dựa trên id
            $sanpham = SanPham::findOrFail($id);

            // Nếu có file mới, xử lý upload ảnh
            if ($request->hasFile('AnhSP')) {
                // Xóa ảnh cũ (nếu có) trước khi upload ảnh mới
                if (file_exists(public_path($sanpham->AnhSP))) {
                    unlink(public_path($sanpham->AnhSP));
                }

                // Lưu file vào thư mục public/uploads
                $fileName = time() . '.' . $request->AnhSP->getClientOriginalExtension();
                $request->AnhSP->move(public_path('uploads'), $fileName);
                $sanpham->AnhSP = 'uploads/' . $fileName; // Cập nhật đường dẫn hình ảnh mới
            }

            // Cập nhật thông tin sản phẩm
            $sanpham->TenSP = $request->input('TenSP');
            $sanpham->GioiTinh = $request->input('GioiTinh');
            $sanpham->ThuongHieu = $request->input('ThuongHieu');
            $sanpham->LoaiMatKinh = $request->input('LoaiMatKinh');
            $sanpham->GiaBan = $request->input('GiaBan');
            $sanpham->SoLuongTonKho = $request->input('SoLuongTonKho');
            $sanpham->MoTaChiTiet = $request->input('MoTaChiTiet');
            $sanpham->MaCLG = $request->input('MaCLG');
            $sanpham->MaCLT = $request->input('MaCLT');
            $sanpham->TrangThaiSP = $request->input('TrangThaiSP');
            $sanpham->MaNCC = $request->input('MaNCC');
            //dd($sanpham);
            $sanpham->save();

            $sp = SanPham::all();
            session()->flash('success', 'Sản phẩm đã được cập nhật.');
            return view("admin.sanpham.review", compact("sp"));
        } catch (QueryException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $sanPham = SanPham::findOrFail($id);
        $sanPham->delete();

        return redirect()->route('admin.sanpham.review')->with('success', 'Sản phẩm đã được xóa.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = SanPham::where('TenSP', 'LIKE', '%' . $query . '%')->get();
        return view('user.sanpham.search', ['products' => $products]);
    }

    public function detail($id)
    {
        $product = SanPham::where('MaSP', $id)->with('loaiSanPham', 'thongSoGong', 'thongSoTrong', 'thuongHieu', 'doMatKinh')->first();
        $products = SanPham::where('LoaiMatKinh', $product->LoaiMatKinh)->get();
        return view('user.sanpham.details', compact('product', 'products'));
    }

    public function autocomplete(Request $request)
    {
        $keyword = $request->get('keyword');

        // Truy vấn các sản phẩm có tên chứa từ khóa
        $products = SanPham::where('TenSP', 'LIKE', '%' . $keyword . '%')->get();

        // Tạo HTML để trả về AJAX
        $output = '';
        if (count($products) > 0) {
            foreach ($products as $product) {
                $output .= '
                    <a href="' . route('sanpham.show', $product->MaSP) . '" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <img src="' . asset($product->AnhSP) . '" style="width: 50px; height: 50px; margin-right: 10px;" alt="' . $product->TenSP . '">
                            <span>' . $product->TenSP . '</span>
                        </div>
                    </a>
                ';
            }
        } else {
            $output .= '<p class="list-group-item">Không tìm thấy sản phẩm</p>';
        }

        return response()->json($output);
    }

}
