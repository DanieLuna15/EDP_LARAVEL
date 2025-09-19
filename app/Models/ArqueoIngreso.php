<?php

namespace App\Models;

use App\Models\Banco;
use App\Models\Formapago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArqueoIngreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro',
        'cajamotivo_id',
        'arqueo_id',
        'tipo',
        'formapago_id',
        'banco_id',
        'nro_comprobante',
        'obs',
        'monto',
        'fecha',
        'estado',
    ];

    public function formapago()
    {
        return $this->belongsTo(Formapago::class, 'formapago_id');
    }
    public function cajamotivo()
    {
        return $this->belongsTo(Cajamotivo::class, 'cajamotivo_id');
    }
    public function arqueo()
    {
        return $this->belongsTo(Arqueo::class, 'arqueo_id');
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }
}
