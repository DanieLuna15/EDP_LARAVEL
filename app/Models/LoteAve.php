<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteAve extends Model
{
    use HasFactory;
    protected $table = 'lotes_aves';
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Compra(){
        return $this->belongsTo(CompraAve::class)->with(['Sucursal','ProveedorCompra']);
    }
    public function LoteDetalles(){
        return $this->hasMany(LoteAveDetalle::class)->with(['PpDetalles','LoteDetalleMovimientos','LoteDetalleProductos'])->where('estado',1);
    }
    public function PpDetalles(){
        return $this->hasMany(PpDetalle::class)->with(['LoteDetalle','PpDetalleDescomposicions','PpPts','Pp'])->where('estado',1);
    }
    public function DetallePps(){
        return $this->hasMany(DetallePp::class)->with(['LoteDetalle','Pp'])->where('estado',1);
    }
    public function DetallePts(){
        return $this->hasMany(DetallePt::class)->with(['LoteDetalle','Pt'])->where('estado',1);
    }
    public function PtDetalles(){
        return $this->hasMany(PtDetalle::class)->with(['LoteDetalle','PtDetalleDescomposicions','PtDetalleSubDescomposicions','SubDesPtDetalleDescos','Pt'])->where('estado',1);
    }
    public function BitacoraLotes(){
        return $this->hasMany(BitacoraLote::class)->where('estado',1);
    }
    public function PpDetalleDescomposicions(){
        return $this->hasMany(PpDetalleDescomposicion::class)->with(['CompoInterna','PpDetalle'])->where('estado',1);
    }
    public function PtDetalleDescomposicions(){
        return $this->hasMany(PtDetalleDescomposicion::class)->with(['CompoExterna','PtDetalle'])->where('estado',1);
    }
    public function LoteDetalleClientes(){
        return $this->hasMany(LoteDetalleCliente::class)->with(['Cliente','LoteDetalle'])->where('estado',1);
    }
}
