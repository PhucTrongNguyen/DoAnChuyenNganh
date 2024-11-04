<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThongTinKhuyenMai extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "thongtinkhuyenmai";
    protected $primaryKey = 'MaKM';

    protected $casts = [
        'MaKM' => 'string',
    ];
    const DELETED_AT = 'NgayXoaKM';
    protected $dates = ['NgayXoaKM'];
    protected $guarded = [];
    public $timestamps = false;
    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'MaKM');
    }
}
