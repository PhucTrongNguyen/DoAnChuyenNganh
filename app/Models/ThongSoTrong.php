<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThongSoTrong extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "thongsotrong";
    protected $primaryKey = 'MaCLT';

    protected $casts = [
        'MaCLT' => 'string',
    ];
    const DELETED_AT = 'NgayXoaCLT';
    protected $dates = ['NgayXoaCLT'];
    protected $guarded = [];
    public $timestamps = false;
    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'MaCLT');
    }
}
