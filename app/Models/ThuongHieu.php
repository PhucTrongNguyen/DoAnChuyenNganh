<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThuongHieu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "thuonghieu";
    protected $primaryKey = 'MaTH';

    protected $casts = [
        'MaTH' => 'string',
    ];
    const DELETED_AT = 'NgayXoaTH';
    protected $dates = ['NgayXoaTH'];
    protected $guarded = [];
    public $timestamps = false;
    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'ThuongHieu');
    }
}
