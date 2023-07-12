<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;

    protected $table = 'pinjam';
    protected $primaryKey = 'id_pinjam';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}

