<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran';
    protected $guarded = [];

    public function subpengujian()
    {
        return $this->belongsTo(Subpengujian::class, 'id_subpengujian', 'id_subpengujian');
    }
}
