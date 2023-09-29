<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tekprod extends Model
{
    use HasFactory;

    protected $table = 'tekprod';
    protected $primaryKey = 'id_tekprod';
    protected $guarded = [];

    public function draft()
    {
        return $this->belongsTo(User::class, 'id_draft_tekprod', 'id');
    }
    
    public function check()
    {
        return $this->belongsTo(User::class, 'id_check_tekprod', 'id'); 
    }
    
    public function approve()
    {
        return $this->belongsTo(User::class, 'id_approve_tekprod', 'id');
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek', 'id_proyek');
    }

    public function subsistem()
    {
        return $this->belongsTo(Subsistem::class, 'id_subsistem', 'id_subsistem');
    }

    public function design()
    {
        return $this->belongsTo(Design::class, 'id_design', 'id_design');
    }

    public function tekproddetail()
    {
        return $this->belongsTo(TekprodDetail::class, 'id_tekprod_detail', 'id_tekprod_detail');
    }

}
