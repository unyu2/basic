<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';
    protected $primaryKey = 'id_proyek';
    protected $guarded = [];

    public function temuan()
    {
        return $this->belongsTo(Temuan::class, 'id_temuan', 'id_temuan');
    }

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'id_permintaan', 'id_permintaan');
    }

    public function konfigurasi()
    {
        return $this->belongsTo(Konfigurasi::class, 'id_konfigurasi', 'id_konfigurasi');
    }

    public function design()
    {
        return $this->belongsTo(Design::class, 'id_design', 'id_design');
    }
}
