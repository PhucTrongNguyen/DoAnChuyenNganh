<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KH_DC extends Model
{
    use HasFactory;
    protected $table = 'kh_dc';
    protected $guarded = [];
    protected $casts = [
        'MaKH' => 'string',
        'MaDC' => 'string'
    ];
    public $timestamps = false;
    public function khachHangs() {
        return $this->hasMany(KhachHang::class, 'MaKH');
    }
    public function diaChis() {
        return $this->hasMany(DiaChi::class, 'MaDC');
    }
}
