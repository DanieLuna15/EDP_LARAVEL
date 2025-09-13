<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtDetalle extends Model
{
    use HasFactory;
    public function LoteDetalle(){
        return $this->belongsTo(LoteDetalle::class)->where('estado',1);
    }
    public function PtDetalleDescomposicions(){
        return $this->hasMany(PtDetalleDescomposicion::class)->with(['CompoExterna','SubDesPtDetalleDescos']);
    }
    public function PtDetalleSubDescomposicions(){
        return $this->hasMany(PtDetalleSubDescomposicion::class)->with(['CompoExternaDetalle']);
    }
    public function PpPt(){
        return $this->hasOne(PpPt::class);
    }
    public function LoteEnvioPt(){
        return $this->hasOne(LoteEnvioPt::class)->where('estado',1);
    }
    public function Lote(){
        return $this->belongsTo(Lote::class)->with(['Compra','User']);
    }
    public function SubDesPtDetalleDescos(){
        return $this->hasMany(SubDesPtDetalleDesco::class)->with(['CompoExternaDetalle'])->where('estado',1);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Pt(){
        return $this->belongsTo(Pt::class);
    }
}
