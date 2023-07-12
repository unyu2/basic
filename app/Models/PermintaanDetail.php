<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanDetail extends Model
{
    use HasFactory;

    protected $table = 'permintaan_detail';
    protected $primaryKey = 'id_permintaan_detail';
    protected $guarded = [];

    public function produk()
    {
        return $this->hasOne(Produk::class, 'id_produk', 'id_produk');
    }

    public function permintaan()
    {
        return $this->hasOne(Permintaan::class, 'id_permintaan', 'id_permintaan');
    }
}
