<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoGlobal extends Model
{
    use HasFactory;
    protected $table = 'pagos_globales';

    protected $guarded = [];

    protected $casts = [
        'ticket_first_printed_at' => 'datetime',
        'ticket_print_count'      => 'integer',
    ];


    public function arqueoVentas()
    {
        return $this->belongsToMany(ArqueoVenta::class, 'arqueo_venta_pago_global');
    }
    public function formapago()
    {
        return $this->belongsTo(Formapago::class, 'formapago_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
