<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TekprodDetail extends Model
{
    use HasFactory;

    protected $table = 'tekprod_detail';
    protected $primaryKey = 'id_tekprod_detail';
    protected $guarded = [];

    public function tekprod()
    {
        return $this->belongsTo(Tekprod::class, 'id_tekprod', 'id_tekprod');
    }
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

    public static function cek($id_tekprod)
    {
        return self::where('id_tekprod', $id_tekprod)->first();
    }

}
