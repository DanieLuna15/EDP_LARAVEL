<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformacionDetalle extends Model
{
    use HasFactory;
    public function TransformacionDetalleSucursals()
    {
        return $this->hasMany(TransformacionDetalleSucursal::class)->where('estado',1)->orderBy('id','desc');
    }
}
