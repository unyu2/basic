<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emu extends Model
{
    use HasFactory;

    protected $table = 'emu';
    protected $primaryKey = 'id_emu';
    protected $guarded = [];

    public function dmu()
    {
        return $this->belongsTo(Dmu::class, 'id_dmu', 'id_dmu');
    }

    public function subpengujian()
    {
        return $this->belongsTo(Subpengujian::class, 'id_subpengujian', 'id_subpengujian');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function setting()
    {
        return $this->belongsto(Setting::class, 'id_setting', 'id_setting');
    }
    public function car()
    {
        return $this->belongsto(Car::class, 'id_car', 'id_car');
    }
    public function proyek()
    {
        return $this->belongsto(Proyek::class, 'id_proyek', 'id_proyek');
    }
}
