<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionAvePagoTicket extends Model
{
    use HasFactory;
    protected $table = 'consolidacionave_pago_tickets';
    public function Banco()
    {
        return $this->belongsTo(Banco::class);
    }
    public function ConsolidacionPago()
    {
        return $this->belongsTo(ConsolidacionAvePago::class, 'consolidacion_pago_id');
    }
    public function Formapago()
    {
        return $this->belongsTo(Formapago::class);
    }
}
