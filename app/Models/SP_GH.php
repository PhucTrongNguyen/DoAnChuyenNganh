<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SP_GH extends Model
{
    use HasFactory;
    protected $table = 'sp_gh';
    protected $guarded = [];
    // Chỉ định khóa chính là sự kết hợp giữa MaSP và MaGH
    //protected $primaryKey = ['MaSP', 'MaGH'];

    // Vì khóa chính không tự tăng, cần đặt thuộc tính này thành false
    public $incrementing = false;

    // Nếu khóa chính không phải là kiểu int, bạn cũng có thể cần thêm dòng này
    protected $keyType = 'string';

    public $timestamps = false;

    public function setKeysForSaveQuery($query)
    {
        // Thiết lập truy vấn để tìm đúng hàng dựa trên cả MaSP và MaGH
        return $query->where('MaSP', $this->getAttribute('MaSP'))
                     ->where('MaGH', $this->getAttribute('MaGH'));
    }

    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'MaSP');
    }
    public function gioHang() {
        return $this->hasMany(GioHang::class, 'MaGH');
    }
}
