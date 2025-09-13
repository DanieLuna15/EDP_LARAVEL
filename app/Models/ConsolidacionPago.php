<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionPago extends Model
{
    use HasFactory;
    public function ConsolidacionPagoDetalles(){
        return $this->hasMany(ConsolidacionPagoDetalle::class);
    }
    public function ConsolidacionPagoTickets(){
        return $this->hasMany(ConsolidacionPagoTicket::class)->with(['Banco']);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function Banco(){
        return $this->belongsTo(Banco::class);
    }
    public function Formapago(){
        return $this->belongsTo(Formapago::class);
    }
}
