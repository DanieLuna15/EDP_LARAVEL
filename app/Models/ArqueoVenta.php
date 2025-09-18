<?php

namespace App\Models;

use App\Models\Formapago;
use App\Models\Banco;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArqueoVenta extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['banco'];

    protected $casts = [
        'cobranza_first_printed_at' => 'datetime',
        'cobranza_print_count'      => 'integer',
        'banco_id'                  => 'integer',
        'comprobante_pago'          => 'string',
    ];
    public function formapago()
    {
        return $this->belongsTo(Formapago::class, 'formapago_id');
    }
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pagosGlobales()
    {
        return $this->belongsToMany(PagoGlobal::class, 'arqueo_venta_pago_global');
    }

    public function banco(): BelongsTo
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }
}
