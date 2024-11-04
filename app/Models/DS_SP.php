<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DS_SP extends Model
{
    use HasFactory;
    protected $table = 'ds_sp';
    protected $guarded = [];
    protected $casts = [
        'MaDS' => 'string',
        'MaSP' => 'string'
    ];
    public $timestamps = false;
    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'MaSP');
    }
    public function danhSachYeuThich() {
        return $this->hasMany(DanhSachYeuThich::class, 'MaDS');
    }
}
