<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhachHang extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "khachhang";
    protected $primaryKey = 'MaKH';

    protected $casts = [
        'MaKH' => 'string',
    ];
    const DELETED_AT = 'NgayXoaTK';
    protected $dates = ['NgayXoaTK'];

    protected $guarded = [];
    public $timestamps = false;

    public function danhGiaKhachHangs() {
        return $this->hasMany(DanhGiaKhachHang::class, 'MaKH');
    }
    public function diaChis(){
        return $this->belongsToMany(DiaChi::class, 'KH_DC', 'MaKH', 'MaDC');
    }
    public function gioHangs() {
        return $this->hasMany(GioHang::class, 'MaKH');
    }
    public function danhSachYeuThichs() {
        return $this->hasMany(DanhSachYeuThich::class, 'MaKH');
    }
}
