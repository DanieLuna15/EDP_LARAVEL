<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformacionLote extends Model
{
    use HasFactory;
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function TransformacionLoteDetalles()
    {
        return $this->hasMany(TransformacionLoteDetalle::class)->where('estado', 1);
    }

    public function TransformacionLoteItems()
    {
        return $this->hasMany(TransformacionLoteItem::class)->with(['Item'])->where('estado', 1);
    }
    public function DescomponerTransformacionLotes()
    {
        return $this->hasMany(DescomponerTransformacionLote::class)->where('estado', 1);
    }
    public function ItemPtTransformacionLotes()
    {
        return $this->hasMany(ItemPtTransformacionLote::class)->where('estado', 1)->with(['Item', 'Pt', 'User', 'SubItemPtTransformacionLotes']);
    }
    public function SubItemPtTransformacionLotes()
    {
        return $this->hasMany(SubItemPtTransformacionLote::class)->where('estado', 1)->with(['Item', 'Pt', 'User', 'SubItem',]);
    }

    public function VentaTransformacions()
    {
        return $this->hasMany(VentaTransformacion::class, 'transformacion_id')
            ->where('estado', 1)
            ->with(['Subitem', 'Venta.User', 'Venta.Cliente']);
    }
}
