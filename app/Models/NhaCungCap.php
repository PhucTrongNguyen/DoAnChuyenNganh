<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhaCungCap extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "nhacungcap";
    protected $primaryKey = 'MaNCC';

    protected $casts = [
        'MaNCC' => 'string',
    ];
    const DELETED_AT = 'NgayXoaNCC';
    protected $dates = ['NgayXoaNCC'];
    protected $guarded = [];
    public $timestamps = false;
    public function nccSP() {
        return $this->belongsTo(NCC_SP::class, 'MaNCC');
    }
}
