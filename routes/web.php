<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\DiaChiController;
use App\Http\Controllers\NguoiQuanLyController;
use App\Http\Controllers\DanhGiaKhachHangController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\ThongSoGongController;
use App\Http\Controllers\ThongSoTrongController;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\DanhSachYeuThichController;
use App\Http\Controllers\LoaiMatKinhController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FacialDetectionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\DoMatKinhController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LanguageController;


Route::post('/run-python-script', [FacialDetectionController::class, 'detectFaces'])->name('run.python.script');

Route::get('/', function () {
    return redirect()->route('sanpham.index');
});

Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('change.language');

//Admin
Route::get('/home', [RegisterUserController::class, 'index'])->name('home');
Route::resource('/posts', PostController::class);
//Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index']);
//->middleware('auth')
//Route::get('/sanpham', [SanPhamController::class, 'paginate'])->name('sanpham.paginate');

Route::get('/sanpham/create', [SanPhamController::class, 'create'])->name('sanpham.create');
Route::post('/sanpham', [SanPhamController::class, 'store'])->name('sanpham.store');
Route::get('/sanpham/{id}/edit', [SanPhamController::class, 'edit'])->name('sanpham.edit');
Route::put('/sanpham/{id}', [SanPhamController::class, 'update'])->name('sanpham.update');
Route::delete('/sanpham/{id}', [SanPhamController::class, 'destroy'])->name('sanpham.destroy');
Route::get('/sanpham', [SanPhamController::class, 'index'])->name('sanpham.index');
Route::get('/sanpham/search', [SanPhamController::class, 'search'])->name('sanpham.search');
Route::get('/sanpham/{id}', [SanPhamController::class, 'getproductinfo'])->name('sanpham.getproductinfo');
Route::get('/sanpham/autocomplete', [SanPhamController::class, 'autocomplete'])->name('sanpham.autocomplete');
Route::get('/sanpham/details/{id}', [SanPhamController::class, 'detail'])->name('sanpham.details');
//Banner
Route::get('/banner/create', [BannerController::class, 'create'])->name('banner.create');
Route::post('/banner', [BannerController::class, 'store'])->name('banner.store');
Route::get('banner/edit/{filename}', [BannerController::class, 'edit'])->name('banner.edit');
Route::put('/banner/{id}', [BannerController::class, 'update'])->name('banner.update');
Route::delete('banner/destroy/{filename}', [BannerController::class, 'destroy'])->name('banner.destroy');
Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
//KhachHang
Route::get('/khachhang', [KhachHangController::class, 'index'])->name('khachhang.index');
//Route::get('/user', [KhachHangController::class, 'user']);
//DiaChi
Route::get('/diachi', [DiaChiController::class, 'index'])->name('diachi.index');
Route::get('/diachi/create', [DiaChiController::class, 'create'])->name('diachi.create');
Route::get('/diachi/{id}/edit', [DiaChiController::class, 'edit'])->name('diachi.edit');
Route::post('/diachi', [DiaChiController::class, 'store'])->name('diachi.store');
Route::delete('/diachi/{id}', [DiaChiController::class, 'destroy'])->name('diachi.destroy');
Route::put('/diachi/{id}', [DiaChiController::class, 'update'])->name('diachi.update');
//NguoiQuanLy
Route::get('/nguoiquanly', [NguoiQuanLyController::class, 'index'])->name('nguoiquanly.index');
Route::get('/nguoiquanly/create', [NguoiQuanLyController::class, 'create'])->name('nguoiquanly.create');
Route::get('/nguoiquanly/{id}/edit', [NguoiQuanLyController::class, 'edit'])->name('nguoiquanly.edit');
Route::post('/nguoiquanly', [NguoiQuanLyController::class, 'store'])->name('nguoiquanly.store');
Route::delete('/nguoiquanly/{id}', [NguoiQuanLyController::class, 'destroy'])->name('nguoiquanly.destroy');
Route::put('/nguoiquanly/{id}', [NguoiQuanLyController::class, 'update'])->name('nguoiquanly.update');
//DanhGiaKhachHang
Route::get('/danhgiakhachhang', [DanhGiaKhachHangController::class, 'index'])->name('danhgiakhachhang.index');
Route::get('/danhgiakhachhang/create', [DanhGiaKhachHangController::class, 'create'])->name('danhgiakhachhang.create');
Route::get('/danhgiakhachhang/{id}/edit', [DanhGiaKhachHangController::class, 'edit'])->name('danhgiakhachhang.edit');
Route::post('/danhgiakhachhang', [DanhGiaKhachHangController::class, 'store'])->name('danhgiakhachhang.store');
Route::delete('/danhgiakhachhang/{id}', [DanhGiaKhachHangController::class, 'destroy'])->name('danhgiakhachhang.destroy');
Route::put('/danhgiakhachhang/{id}', [DanhGiaKhachHangController::class, 'update'])->name('danhgiakhachhang.update');
//ThuongHieu
Route::get('/thuonghieu', [ThuongHieuController::class, 'index'])->name('thuonghieu.index');
Route::get('/thuonghieu/create', [ThuongHieuController::class, 'create'])->name('thuonghieu.create');
Route::get('/thuonghieu/{id}/edit', [ThuongHieuController::class, 'edit'])->name('thuonghieu.edit');
Route::post('/thuonghieu', [ThuongHieuController::class, 'store'])->name('thuonghieu.store');
Route::delete('/thuonghieu/{id}', [ThuongHieuController::class, 'destroy'])->name('thuonghieu.destroy');
Route::put('/thuonghieu/{id}', [ThuongHieuController::class, 'update'])->name('thuonghieu.update');
//GioHang
Route::get('/giohang', [GioHangController::class, 'index'])->name('giohang.index');
//ThongSoGong
Route::get('/thongsogong', [ThongSoGongController::class, 'index'])->name('thongsogong.index');
Route::get('/thongsogong/create', [ThongSoGongController::class, 'create'])->name('thongsogong.create');
Route::get('/thongsogong/{id}/edit', [ThongSoGongController::class, 'edit'])->name('thongsogong.edit');
Route::post('/thongsogong', [ThongSoGongController::class, 'store'])->name('thongsogong.store');
Route::delete('/thongsogong/{id}', [ThongSoGongController::class, 'destroy'])->name('thongsogong.destroy');
Route::put('/thongsogong/{id}', [ThongSoGongController::class, 'update'])->name('thongsogong.update');
//ThongSoTrong
Route::get('/thongsotrong', [ThongSoTrongController::class, 'index'])->name('thongsotrong.index');
Route::get('/thongsotrong/create', [ThongSoTrongController::class, 'create'])->name('thongsotrong.create');
Route::get('/thongsotrong/{id}/edit', [ThongSoTrongController::class, 'edit'])->name('thongsotrong.edit');
Route::post('/thongsotrong', [ThongSoTrongController::class, 'store'])->name('thongsotrong.store');
Route::delete('/thongsotrong/{id}', [ThongSoTrongController::class, 'destroy'])->name('thongsotrong.destroy');
Route::put('/thongsotrong/{id}', [ThongSoTrongController::class, 'update'])->name('thongsotrong.update');
//NhaCungCap
Route::get('/nhacungcap', [NhaCungCapController::class, 'index'])->name('nhacungcap.index');
Route::get('/nhacungcap/create', [NhaCungCapController::class, 'create'])->name('nhacungcap.create');
Route::get('/nhacungcap/{id}/edit', [NhaCungCapController::class, 'edit'])->name(name: 'nhacungcap.edit');
Route::post('/nhacungcap', [NhaCungCapController::class, 'store'])->name('nhacungcap.store');
Route::delete('/nhacungcap/{id}', [NhaCungCapController::class, 'destroy'])->name('nhacungcap.destroy');
Route::put('/nhacungcap/{id}', [NhaCungCapController::class, 'update'])->name('nhacungcap.update');
//DanhSachYeuThich
Route::get('/danhsachyeuthich', [DanhSachYeuThichController::class, 'index'])->name('danhsachyeuthich.index');
//LoaiMatKinh
Route::get('/loaimatkinh', [LoaiMatKinhController::class, 'index'])->name('loaimatkinh.index');
Route::get('/loaimatkinh/create', [LoaiMatKinhController::class, 'create'])->name('loaimatkinh.create');
Route::get('/loaimatkinh/{id}/edit', [LoaiMatKinhController::class, 'edit'])->name(name: 'loaimatkinh.edit');
Route::get('/loaimatkinh/restore', [LoaiMatKinhController::class, 'restore'])->name('loaimatkinh.restore');
Route::post('/loaimatkinh', [LoaiMatKinhController::class, 'store'])->name('loaimatkinh.store');
Route::delete('/loaimatkinh/{id}', [LoaiMatKinhController::class, 'destroy'])->name('loaimatkinh.destroy');
Route::put('/loaimatkinh/{id}', [LoaiMatKinhController::class, 'update'])->name('loaimatkinh.update');
//DoMatKinh
Route::get('/domatkinh', [DoMatKinhController::class, 'index'])->name('domatkinh.index');
Route::get('/domatkinh/create', [DoMatKinhController::class, 'create'])->name('domatkinh.create');
Route::get('/domatkinh/{id}/edit', [DoMatKinhController::class, 'edit'])->name(name: 'domatkinh.edit');
Route::get('/domatkinh/restore', [DoMatKinhController::class, 'restore'])->name('domatkinh.restore');
Route::post('/domatkinh', [DoMatKinhController::class, 'store'])->name('domatkinh.store');
Route::delete('/domatkinh/{id}', [DoMatKinhController::class, 'destroy'])->name('domatkinh.destroy');
Route::put('/domatkinh/{id}', [DoMatKinhController::class, 'update'])->name('domatkinh.update');
//Don Hang
Route::get('/donhang', [DonHangController::class, 'index'])->name('donhang.index');
Route::get('/donhang/{id}/edit', [DonHangController::class, 'edit'])->name(name: 'donhang.edit');
Route::get('/donhang/restore', [DonHangController::class, 'restore'])->name('donhang.restore');
Route::delete('/donhang/{donHang}/{sanPham}', [DonHangController::class, 'destroy'])->name('donhang.destroy');
Route::get('/donhang/cancel', [DonHangController::class, 'cancel'])->name('donhang.cancel');
Route::post('/donhang/bulkorder', [DonHangController::class, 'bulkOrder'])->name('donhang.bulkorder');
Route::put('/donhang/{id}', [DonHangController::class, 'update'])->name('donhang.update');
Route::post('/donhang/check', [DonHangController::class, 'checkOrder'])->name('donhang.check');
Route::put('/donhang/{MaDH}/updateStatus', [DonHangController::class, 'updateStatus'])->name('donhang.updateStatus');

//User
//SanPham
//Route::get('/', [SanPhamController::class, 'index']);
Route::get('/products/search', [SanPhamController::class, 'search'])->name('products.search');
//Login
//Route::get('/login', [AuthController::class, 'login'])->name('Auth.login');
//HoSo
// Route::group(['middleware' => ['check.session']], function () {
    
// });

Route::get('/hoso', [KhachHangController::class, 'profile'])->name('hoso.profile');
Route::get('/profile/create', [KhachHangController::class, 'create'])->name('hoso.create');
Route::put('/profile', [KhachHangController::class, 'store'])->name('hoso.store');
Route::get('/profile/edit/{id}', [KhachHangController::class, 'edit'])->name('hoso.edit');
Route::put('/profile/{id}', [KhachHangController::class, 'update'])->name('hoso.update');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::delete('cart/remove/{MaSP}', [GioHangController::class, 'removeItem'])->name('cart.remove');
Route::get('/cart', [GioHangController::class, 'review'])->name('cart.index');
Route::post('/cart/add/{MaSP}', [GioHangController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/count', [GioHangController::class, 'getCartCount'])->name('cart.count');
Route::post('/cart/update', [GioHangController::class, 'update'])->name('cart.update');
Route::post('/cart/check', [GioHangController::class, 'checkCart'])->name('cart.check');

Route::controller(DanhSachYeuThichController::class)->group(function () {
    Route::post('/favorites/add/{MaSP}', 'addFavorite')->name('favorite.add');
    Route::get('/favorites', 'review')->name('favorite.index');
    Route::delete('/favorites/remove/{MaSP}', 'removeFavorite')->name('favorite.remove');
    Route::get('/favorites/count', 'getFavoriteCount')->name('favorite.count');
    Route::post('/favorites/check', 'checkFavorites')->name('favorite.check');
});

Route::post('/checkout-bulkPayment', [CheckoutController::class, 'bulkPayment'])->name('checkout.bulkPayment');
Route::post('/payment-complete', [CheckoutController::class, 'paymentComplete'])->name('checkout.paymentComplete');
Route::get('/checkout-payment', [CheckoutController::class, 'checkoutPayment'])->name('checkout.payment');
Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout.success');

Route::resource('posts', PostController::class);