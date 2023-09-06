<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignDetail extends Model
{
    use HasFactory;

    protected $table = 'design_detail';
    protected $primaryKey = 'id_design_detail';
    protected $guarded = [];

    public function design()
    {
        return $this->belongsTo(Design::class, 'id_design', 'id_design');
    }
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

    public static function cek($id_design)
    {
        return self::where('id_design', $id_design)->first();
    }

}
