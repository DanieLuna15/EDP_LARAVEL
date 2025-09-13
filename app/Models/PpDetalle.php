<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpDetalle extends Model
{
    use HasFactory;
    public function LoteDetalle(){
        return $this->belongsTo(LoteDetalle::class)->where('estado',1);
    }
    public function PpDetalleDescomposicions(){
        return $this->hasMany(PpDetalleDescomposicion::class)->with(['CompoInterna']);
    }
    public function PpPts(){
        return $this->hasMany(PpPt::class)->where('estado',1);
    }
    public function LoteDetalleMovimiento(){
        return $this->belongsTo(LoteDetalleMovimiento::class)->where('estado',1);
    }
    public function Pp(){
        return $this->belongsTo(Pp::class);
    }
}
