<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'car';
    protected $primaryKey = 'id_car';
    protected $guarded = [];

//    public function emu()
//    {
//        return $this->hasMany(Emu::class, 'id_emu', 'id_emu');
//    } 
}