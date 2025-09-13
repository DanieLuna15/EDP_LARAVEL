<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoClienteDetalle extends Model
{
    use HasFactory;
    public function PedidoCliente()
    {
        return $this->belongsTo(PedidoCliente::class);
    }
    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
}
