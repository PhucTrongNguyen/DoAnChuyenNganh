<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GioHang extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "giohang";
    protected $primaryKey = 'MaGH';

    protected $casts = [
        'MaGH' => 'string',
    ];
    const DELETED_AT = 'NgayXoaGH';
    protected $dates = ['NgayXoaGH'];
    protected $guarded = [];
    public $timestamps = false;

    public function sanPhams(){
        return $this->belongsToMany(SanPham::class, 'SP_GH', 'MaGH', 'MaSP')
        ->withPivot('SoLuongSP', 'DonGia', 'ThanhTien');
    }
    public function khachHang() {
        return $this->belongsTo(KhachHang::class, 'MaKH');
    }
}
