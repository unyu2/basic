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

}
