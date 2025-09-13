<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePt extends Model
{
    use HasFactory;
    public function Pt(){
        return $this->belongsTo(Pt::class);
    }
    public function LoteDetalle()
    {
        return $this->belongsTo(LoteDetalle::class)->where('estado',1);
    }
    public function LoteDetalleMovimiento()
    {
        return $this->belongsTo(LoteDetalleMovimiento::class)->where('estado',1);
    }
    public function DetallePtDescomposicions()
    {
        return $this->hasMany(DetallePtDescomposicion::class)->with(['CompoExterna','SubDesDetallePts'])->where('estado',1);
    }
    public function SubDesDetallePts()
    {
        return $this->hasMany(SubDesDetallePt::class)->with(['CompoExternaDetalle'])->where('estado',1);
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
