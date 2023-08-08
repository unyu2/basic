<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamDetail extends Model
{
    use HasFactory;

    protected $table = 'pinjam_detail';
    protected $primaryKey = 'id_pinjam_detail';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class, 'id_pinjam', 'id_pinjam');
    }
}