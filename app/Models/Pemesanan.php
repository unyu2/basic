<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    protected $guarded = [];

    public function member()
    {
        return $this->hasOne(Member::class, 'id_member', 'id_member');
    }

    public function proyek()
    {
        return $this->hasOne(Proyek::class, 'id_proyek', 'id_proyek');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}

