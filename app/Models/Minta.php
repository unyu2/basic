<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minta extends Model
{
    use HasFactory;

    protected $table = 'permintaan_detail';
    protected $primaryKey = 'id_permintaan_detail';
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'id_permintaan', 'id_permintaan');
    }
}