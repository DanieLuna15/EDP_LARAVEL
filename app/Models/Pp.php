<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pp extends Model
{
    use HasFactory;
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function DetallePps()
    {
        return $this->hasMany(DetallePp::class)->with(['LoteDetalle','DetallePpDescomposicions','LoteDetalle.Compra'])->where('estado',1);
    }
    public function TraspasoPps()
    {
        return $this->hasMany(TraspasoPp::class)->where('estado',1);
    }
    public function PpTraspasoPps()
    {
        return $this->hasMany(PpTraspasoPp::class)->with(['TraspasoPp'])->where('estado',1);
    }
    public function VentaDetallePps()
    {
        return $this->hasMany(VentaDetallePp::class)->with(['Cliente']);
    }
    public function DespleguePps()
    {
        return $this->hasMany(DespleguePp::class)->where('estado',1);
    }
    public function SobraPps(){
        return $this->hasMany(SobraPp::class);
    }
    public function PpEnvioTransformacionDetalles()
    {
        return $this->hasMany(PpEnvioTransformacionDetalle::class)->where('estado',1);
    }
    public function subdetalleDescuentoAcuerdos()
    {
        return $this->hasMany(SubdetalleDescuentoAcuerdo::class, 'pp_id');
    }
}
