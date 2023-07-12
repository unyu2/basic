<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temuan extends Model
{
    use HasFactory;

    protected $table = 'temuan';
    protected $primaryKey = 'id_temuan';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek', 'id_proyek');
    }
    public function emu()
    {
        return $this->belongsTo(Emu::class, 'id_emu', 'id_emu');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
    public function car()
    {
        return $this->belongsTo(Car::class, 'id_car', 'id_car');
    }


}
