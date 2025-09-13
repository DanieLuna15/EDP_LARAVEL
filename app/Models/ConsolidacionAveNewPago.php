<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionAveNewPago extends Model
{
    use HasFactory;
    protected $table = 'consolidacionavenew_pagos';
    public function ConsolidacionPagoDetalles()
    {
        return $this->hasMany(ConsolidacionAveNewPagoDetalle::class, 'consolidacion_pago_id');
    }
    public function ConsolidacionPagoTickets()
    {
        return $this->hasMany(ConsolidacionAveNewPagoTicket::class, 'consolidacion_pago_id')->with(['Banco']);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function Banco()
    {
        return $this->belongsTo(Banco::class);
    }
    public function Formapago()
    {
        return $this->belongsTo(Formapago::class);
    }
}
