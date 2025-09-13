<?php

namespace App\Models;

use App\Models\Formapago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArqueoVenta extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'cobranza_first_printed_at' => 'datetime',
        'cobranza_print_count'      => 'integer',
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
}
