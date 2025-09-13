<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DespleguePp extends Model
{
    use HasFactory;
    public function CintaCliente()
    {
        return $this->belongsTo(CintaCliente::class);
    }
    public function Pp()
    {
        return $this->belongsTo(Pp::class);
    }
}
