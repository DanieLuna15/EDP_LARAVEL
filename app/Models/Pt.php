<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pt extends Model
{
    use HasFactory;
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function DetallePts()
    {
        return $this->hasMany(DetallePt::class)->with(['LoteDetalle','DetallePtDescomposicions','SubDesDetallePts','LoteDetalle.Compra','LoteDetalleMovimiento'])->where('estado',1);
    }
    public function PtTraspasoPps()
    {
        return $this->hasMany(PtTraspasoPp::class)->with(['TraspasoPp']);
    }
    public function PtSobraPps()
    {
        return $this->hasMany(PtSobraPp::class)->with(['SobraPp']);
    }
    public function DescomponerPts() {
        return $this->hasMany(DescomponerPt::class, 'pt_id');
    }
    public function ItemsPts()
    {
        return $this->hasMany(ItemsPt::class)->with(['Item']);
    }
    public function ItemPtMovimientos()
    {
        return $this->hasMany(ItemPtMovimiento::class)->with(['Item','User']);
    }
    public function VentaItemsPts()
    {
        return $this->hasMany(VentaItemsPt::class)->with(['Item','Venta']);
    }
    public function EnviarItemPtTransformacions()
    {
        return $this->hasMany(EnviarItemPtTransformacion::class)->where('estado',1);
    }
    public function ItemSobraPts()
    {
        return $this->hasMany(ItemSobraPt::class);
    }
}
