<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaInventario extends Model
{
    use HasFactory;
    public function Caja(){
        return $this->belongsTo(Caja::class);
    }
    public function Almacen(){
        return $this->belongsTo(Almacen::class);
    }
}
