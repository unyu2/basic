<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranDetail extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_detail';
    protected $primaryKey = 'id_pendaftaran_detail';
    protected $guarded = [];

    public function pengujian()
    {
        return $this->hasOne(Pengujian::class, 'id_pengujian', 'id_pengujian');
    }

    public function subpengujian()
    {
        return $this->hasOne(Subpengujian::class, 'id_subpengujian', 'id_subpengujian');
    }
}
