<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionPagoTicket extends Model
{
    use HasFactory;
    public function Banco(){
        return $this->belongsTo(Banco::class);
    }
    public function ConsolidacionPago(){
        return $this->belongsTo(ConsolidacionPago::class);
    }
    public function Formapago(){
        return $this->belongsTo(Formapago::class);
    }
}
