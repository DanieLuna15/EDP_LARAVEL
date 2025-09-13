<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtDetalleDescomposicion extends Model
{
    use HasFactory;
    public function CompoExterna(){
        return $this->belongsTo(CompoExterna::class)->with(['CompoExternaDetalles']);
    }
    public function SubDesPtDetalleDescos(){
        return $this->hasMany(SubDesPtDetalleDesco::class)->with(['CompoExternaDetalle'])->where('estado',1);
    }
    public function PtDetalle(){
        return $this->belongsTo(PtDetalle::class)->with(['LoteDetalle']);
    }
}
