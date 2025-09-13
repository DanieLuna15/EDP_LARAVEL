<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoCliente extends Model
{
    use HasFactory;
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function Chofer()
    {
        return $this->belongsTo(Chofer::class);
    }
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function FormaPago()
    {
        return $this->belongsTo(FormaPago::class);
    }
    public function PedidoClienteDetalles()
    {
        return $this->hasMany(PedidoClienteDetalle::class);
    }
}
