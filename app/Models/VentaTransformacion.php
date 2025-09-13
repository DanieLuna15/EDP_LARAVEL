<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaTransformacion extends Model
{
    use HasFactory;
    public function Subitem(){
        return $this->belongsTo( Item::class);
    }
    public function Venta(){
        return $this->belongsTo( Venta::class);
    }
    public function Transformacion(){
        return $this->belongsTo( TransformacionLote::class);
    }
    public function Pt(){
        return $this->belongsTo( Pt::class);
    }


}
