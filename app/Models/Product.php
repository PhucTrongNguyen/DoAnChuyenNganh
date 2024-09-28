<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    // Khai báo các cột có thể được thêm/sửa
    protected $fillable = [
        'proc_id',
        'cate_id',
        'name',
        'quantity',
        'price',
        'picture',
    ];

    // Khai báo khóa chính là proc_id
    protected $primaryKey = 'proc_id';
    public $incrementing = false;  // Đối với khóa chính không phải tự tăng
    protected $keyType = 'char';  // Kiểu dữ liệu của khóa chính

    // Cấu hình soft delete
    protected $dates = ['deleted_at'];
}
