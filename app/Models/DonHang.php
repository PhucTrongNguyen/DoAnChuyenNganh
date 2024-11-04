<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonHang extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "donhang";
    protected $primaryKey = 'MaDH';

    protected $casts = [
        'MaDH' => 'string',
    ];
    const DELETED_AT = 'NgayHuyDH';
    protected $dates = ['NgayHuyDH'];
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    public function sanPhams(){
        return $this->belongsToMany(SanPham::class, 'SP_DH', 'MaDH', 'MaSP')->withPivot('SoLuongSP', 'DonGia', 'ThanhTien');;
    }
}
