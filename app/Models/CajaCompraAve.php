<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaCompraAve extends Model
{
    use HasFactory;
    protected $table = 'caja_compras_aves';
    public function Caja()
    {
        return $this->belongsTo(Caja::class);
    }
    public function CajaInventario()
    {
        return $this->belongsTo(CajaInventario::class)->with(['Almacen', 'Caja']);
    }
    public function Compra()
    {
        return $this->belongsTo(CompraAve::class)->with(['Consolidacion', 'ProveedorCompra', 'User']);
    }
}
