<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoMatKinh extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "domatkinh";
    protected $primaryKey = 'MaDo';

    protected $casts = [
        'MaDo' => 'string',
    ];
    const DELETED_AT = 'NgayXoaDo';
    protected $dates = ['NgayXoaDo'];
    protected $guarded = [];
    public $timestamps = false;

    public function sanPhams(){
        return $this->hasMany(SanPham::class, 'Do');
    }
}
