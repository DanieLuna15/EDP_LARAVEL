<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionAveNewPagoTicket extends Model
{
    use HasFactory;
    protected $table = 'consolidacionavenew_pago_tickets';
    public function Banco()
    {
        return $this->belongsTo(Banco::class);
    }
    public function ConsolidacionPago()
    {
        return $this->belongsTo(ConsolidacionAveNewPago::class, 'consolidacion_pago_id');
    }
    public function Formapago()
    {
        return $this->belongsTo(Formapago::class);
    }
}
