<?php

namespace App\Models;

use App\Models\Formapago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArqueoIngreso extends Model
{
    use HasFactory;
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
}
