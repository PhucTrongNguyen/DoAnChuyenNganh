<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NCC_SP extends Model
{
    use HasFactory;
    protected $table = "ncc_sp";

    protected $casts = [
        'MaNCC' => 'string',
        'MaSP' => 'string'
    ];

    protected $guarded = [];
    public $timestamps = false;
    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'MaSP');
    }
    public function nhaCungCaps() {
        return $this->hasMany(NhaCungCap::class, 'MaNCC');
    }
}
