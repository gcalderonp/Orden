<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdenDet;

class Orden extends Model
{
    use HasFactory;
    protected $fillable = ['estado'];

    //relacion 1 a n con orden_dets
    public function orden_dets(){
        return $this->hasMany(orden_dets::class);
    }

}
