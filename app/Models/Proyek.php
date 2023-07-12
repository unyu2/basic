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
        return $this->hasMany(Temuan::class, 'id_temuan', 'id_temuan');
    }

    public function permintaan()
    {
        return $this->hasMany(Permintaan::class, 'id_permintaan', 'id_permintaan');
    }
}
