<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SP_DH extends Model
{
    use HasFactory;
    protected $table = 'sp_dh';
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
                     ->where('MaDH', $this->getAttribute('MaDH'));
    }

    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'MaSP');
    }
    public function donHangs() {
        return $this->hasMany(DonHang::class, 'MaDH');
    }
}
