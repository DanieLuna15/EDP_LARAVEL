<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaCaja extends Model
{
    protected $guarded = [];

    protected $casts = [
        'cajas_first_printed_at' => 'datetime',
        'cajas_chofer_first_printed_at' => 'datetime',
        'cajas_print_count' => 'integer',
        'cajas_chofer_print_count' => 'integer',
    ];

    use HasFactory;
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function Chofer()
    {
        return $this->belongsTo(Chofer::class, 'chofer_id');
    }
}
