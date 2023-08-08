<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $table = 'design';
    protected $primaryKey = 'id_design';
    protected $guarded = [];

    public function draft()
    {
        return $this->belongsTo(User::class, 'id_draft', 'id');
    }
    
    public function check()
    {
        return $this->belongsTo(User::class, 'id_check', 'id'); 
    }
    
    public function approve()
    {
        return $this->belongsTo(User::class, 'id_approve', 'id');
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek', 'id_proyek');

        
    }

    public function subsistem()
    {
        return $this->belongsTo(Subsistem::class, 'id_subsistem', 'id_subsistem');
        
    }

    public function kepalagambar()
    {
        return $this->belongsTo(KepalaGambar::class, 'id_kepala_gambar', 'id_kepala_gambar');
        
    }

    public function designdetail()
    {
        return $this->hasMany(DesignDetail::class, 'id_design_detail', 'id_design_detail');
    }

}
