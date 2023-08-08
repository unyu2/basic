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
        return $this->belongsTo(Pengujian::class, 'id_pengujian', 'id_pengujian');
    }

    public function subpengujian()
    {
        return $this->belongsTo(Subpengujian::class, 'id_subpengujian', 'id_subpengujian');
    }

    public function pendafaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_pendaftaran');
    }
}
