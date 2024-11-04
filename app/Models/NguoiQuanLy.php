<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguoiQuanLy extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "nguoiquanly";
    protected $primaryKey = 'MaQL';

    protected $casts = [
        'MaQL' => 'string',
    ];
    const DELETED_AT = 'NgayXoaTK';
    protected $dates = ['NgayXoaTK'];
    protected $guarded = [];
    public $timestamps = false;
}
