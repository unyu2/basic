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

    public function users()
    {
        return $this->belongsTo(User::class, 'id', 'id_users');
        
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek', 'id_proyek');
        
    }

    public function sistem()
    {
        return $this->belongsTo(Sistem::class, 'id_sistem', 'nama_dmu');
        
    }

    public function subsistem()
    {
        return $this->belongsTo(Subsistem::class, 'id_subsistem', 'nama_dmu1', 'nama_dmu2', 'nama_dmu3', 'nama_dmu4', 'nama_dmu5', 
        'nama_dmu6', 'nama_dmu7', 'nama_dmu8', 'nama_dmu9', 'nama_dmu10', 
        'nama_dmu11', 'nama_dmu12', 'nama_dmu13', 'nama_dmu14');
        
    }

}
