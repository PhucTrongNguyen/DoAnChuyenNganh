<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhGiaKhachHang extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "danhgiakhachhang";
    protected $primaryKey = 'MaDG';

    protected $casts = [
        'MaDG' => 'string',
    ];
    const DELETED_AT = 'NgayXoaDG';
    protected $dates = ['NgayXoaDG'];
    protected $guarded = [];
    public $timestamps = false;
    public function khachHang() {
        return $this->belongsTo(KhachHang::class, 'MaKH');
    }
}
