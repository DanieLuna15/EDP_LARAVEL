<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaCajaRecuperada extends Model
{
    use HasFactory;
    protected $table = 'entrega_cajas_recuperadas';
        protected $fillable = [
        'cliente_id',
        'cajas',
        'fecha',
        'estado',
        'entrega_id',
        'chofer_id',
    ];
}
