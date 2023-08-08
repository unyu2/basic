<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsistem extends Model
{
    use HasFactory;

    protected $table = 'subsistem';
    protected $primaryKey = 'id_subsistem';
    protected $guarded = [];

    
    public function sistem()
    {
        return $this->belongsTo(Sistem::class, 'id_sistem', 'id_sistem');
    }
}

