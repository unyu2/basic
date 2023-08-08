<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaGambar extends Model
{
    use HasFactory;

    protected $table = 'kepala_gambar';
    protected $primaryKey = 'id_kepala_gambar';
    protected $guarded = [];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }
}
