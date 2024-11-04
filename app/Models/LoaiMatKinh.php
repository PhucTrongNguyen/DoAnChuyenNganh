<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoaiMatKinh extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "loaimatkinh";
    protected $primaryKey = 'MaLoai';

    protected $casts = [
        'MaLoai' => 'string',
    ];
    // Định nghĩa tên cột custom cho soft deletes
    const DELETED_AT = 'NgayXoaLoaiMK';
    protected $dates = ['NgayXoaLoaiMK'];
    protected $guarded = [];
    public $timestamps = false;

    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'LoaiMatKinh');
    }
}
