<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "sanpham";
    protected $primaryKey = 'MaSP';

    protected $casts = [
        'MaSP' => 'string',
    ];
    const DELETED_AT = 'NgayXoaSP';
    protected $dates = ['NgayXoaSP'];
    protected $guarded = [];
    public $timestamps = false;

    public function loaiSanPham() {
        return $this->belongsTo(LoaiMatKinh::class, 'LoaiMatKinh');
    }
    public function thongSoGong() {
        return $this->belongsTo(ThongSoGong::class, 'MaCLG');
    }
    public function thongSoTrong() {
        return $this->belongsTo(ThongSoTrong::class, 'MaCLT');
    }
    public function thuongHieu() {
        return $this->belongsTo(ThuongHieu::class, 'ThuongHieu');
    }
    public function nccSP() {
        return $this->belongsTo(NCC_SP::class, 'MaSP');
    }
    public function gioHangs() {
        return $this->belongsToMany(GioHang::class, 'SP_GH', 'MaSP', 'MaGH')
        ->withPivot('SoLuongSP', 'DonGia','ThanhTien');
    }
    public function danhSachYeuThichs() {
        return $this->belongsToMany(DanhSachYeuThich::class, 'DS_SP', 'MaSP', 'MaDS');
    }
    public function doMatKinh() {
        return $this->belongsTo(DoMatKinh::class, 'Do');
    }
    public function donHangs(){
        return $this->belongsToMany(DonHang::class, 'SP_DH', 'MaSP', 'MaDH');
    }
}
