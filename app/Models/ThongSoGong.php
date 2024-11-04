<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThongSoGong extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "thongsogong";
    protected $primaryKey = 'MaCLG';

    protected $casts = [
        'MaCLG' => 'string',
    ];
    const DELETED_AT = 'NgayXoaCLG';
    protected $dates = ['NgayXoaCLG'];
    protected $guarded = [];
    public $timestamps = false;
    public function sanPhams() {
        return $this->hasMany(SanPham::class, 'MaCLG');
    }
}
