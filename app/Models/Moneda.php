<?php

namespace App\Models;

use App\Models\Filemoneda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moneda extends Model
{
    use HasFactory;

    public function Filemonedas()
    {
        return $this->hasMany(Filemoneda::class)->with(['Tipoarchivo', 'File'])->where('estado', 1);
    }
}
