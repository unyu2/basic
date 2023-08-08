<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subpengujian extends Model
{
    use HasFactory;

    protected $table = 'subpengujian';
    protected $primaryKey = 'id_subpengujian';
    protected $guarded = [];

    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'id_pengujian', 'id_pengujian');
    }

    public function emu()
    {
        return $this->hasMany(Emu::class, 'id_subpengujian', 'id_subpengujian');
    }
}
