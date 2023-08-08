<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmuCtrl extends Model
{
    use HasFactory;

    protected $table = 'emu';
    protected $primaryKey = 'id_emu';
    protected $guarded = [];

    public function dmu()
    {
        return $this->belongsTo(Dmu::class, 'id_dmu', 'id_dmu');
    }

    public function subpengujian()
    {
        return $this->belongsTo(Subpengujian::class, 'id_subpengujian', 'id_subpengujian');
    }

    public function user()
    {
        return $this->belongsto(User::class, 'id', 'id_user');
    }
    public function proyek()
    {
        return $this->belongsto(Proyek::class, 'id_proyek', 'id_proyek');
    }
}