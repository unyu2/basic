<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dwg extends Model
{
    use HasFactory;

    protected $table = 'dwg';
    protected $primaryKey = 'id_dwg';
    protected $guarded = [];

    public function draft()
    {
        return $this->belongsTo(User::class, 'id', 'id_draft');
        
    }

    public function check()
    {
        return $this->belongsTo(User::class, 'id', 'id_check');
        
    }

    public function approve()
    {
        return $this->belongsTo(User::class, 'id', 'id_approve');
        
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id', 'id_proyek');
        
    }

    public function subsistem()
    {
        return $this->belongsTo(Subsistem::class, 'id_subsistem', 'id_subsistem');
        
    }

    public function kepalagambar()
    {
        return $this->belongsTo(KepalaGambar::class, 'id_kepala_gambar', 'id_kepala_gambar');
        
    }

}