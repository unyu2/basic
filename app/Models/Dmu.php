<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dmu extends Model
{
    use HasFactory;

    protected $table = 'dmu';
    protected $primaryKey = 'id_dmu';
    protected $guarded = [];

    public function subpengujian()
    {
        return $this->belongsTo(Subpengujian::class, 'id_subpengujian', 'id_subpengujian');
    }

    public function emu()
    {
        return $this->belongsTo(Emu::class, 'id_emu', 'id_emu');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
        
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek', 'id_proyek');
        
    }

    public function sistem()
    {
        return $this->belongsTo(Sistem::class, 'id_sistem', 'nama_dmu');
        
    }

}
