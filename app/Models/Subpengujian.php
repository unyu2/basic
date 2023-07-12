<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subpengujian extends Model
{
    use HasFactory;

    protected $table = 'subpengujian';
    protected $primaryKey = 'id_subpengujian';
    protected $guarded = [];
}
