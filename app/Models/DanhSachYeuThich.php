<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhSachYeuThich extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "danhsachyeuthich";
    protected $primaryKey = 'MaDS';

    protected $casts = [
        'MaDS' => 'string',
    ];
    const DELETED_AT = 'NgayXoaDS';
    protected $dates = ['NgayXoaDS'];
    protected $guarded = [];
    public $timestamps = false;
    public function khachHang() {
        return $this->belongsTo(KhachHang::class, 'MaKH');
    }
    public function sanPhams(){
        return $this->belongsToMany(SanPham::class, 'DS_SP', 'MaDS', 'MaSP');
    }
}
