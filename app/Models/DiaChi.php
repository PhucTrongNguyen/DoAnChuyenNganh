<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiaChi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "diachi";
    protected $primaryKey = 'MaDC';

    protected $casts = [
        'MaDC' => 'string',
    ];
    const DELETED_AT = 'NgayXoaDC';
    protected $dates = ['NgayXoaDC'];
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    public function khachHangs(){
        return $this->belongsToMany(KhachHang::class, 'KH_DC', 'MaDC', 'MaKH');
    }
}
