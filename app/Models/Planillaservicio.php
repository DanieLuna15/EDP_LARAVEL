<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planillaservicio extends Model
{
    use HasFactory;
    public function Contrato()
    {
        return $this->belongsTo(Contrato::class)->with(['Persona', 'Adeudas', 'Area']);
    }

    public function Planillaserviciocostos()
    {
        return $this->hasMany(Planillaserviciocosto::class)->with(['costovariable']);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
