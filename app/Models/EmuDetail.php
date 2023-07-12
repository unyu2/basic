<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmuDetail extends Model
{
    use HasFactory;

    protected $table = 'emu_detail';
    protected $primaryKey = 'id_emu_detail';
    protected $guarded = [];

    public function produk()
    {
        return $this->hasOne(Produk::class, 'id_produk', 'id_produk');
    }

    public function proyek()
    {
        return $this->hasOne(Proyek::class, 'id_proyek', 'id_proyek');
    }
}
