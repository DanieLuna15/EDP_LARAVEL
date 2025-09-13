<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    public function Area()
    {
        return $this->belongsTo(Area::class);
    }
    public function Persona()
    {
        return $this->belongsTo(Persona::class)->with(['Documento']);
    }
    public function Adeudas()
    {
        return $this->hasMany(Adeuda::class)->with(['Adeudacuotas'])->where('estado', 1);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function Tipocontrato()
    {
        return $this->belongsTo(Tipocontrato::class);
    }
    public function Planilla()
    {
        return $this->hasOne(Planilla::class)->orderBy('id', 'desc');
    }
    public function Finiquitoanual()
    {
        return $this->hasOne(Finiquitoanual::class)->orderBy('id', 'desc');
    }
    public function Finiaguinaldo()
    {
        return $this->hasOne(Finiaguinaldo::class)->orderBy('id', 'desc');
    }
    public function Finivacacional()
    {
        return $this->hasOne(Finivacacional::class)->orderBy('id', 'desc');
    }
    public function Liquidacion()
    {
        return $this->hasOne(Liquidacion::class)->orderBy('id', 'desc');
    }
    public function Contratocostos()
    {
        return $this->hasMany(Contratocosto::class)->with(['Costofijo']);
    }
    public function Planillas()
    {
        return $this->hasMany(Planilla::class);
    }
    public function Finivacacionals()
    {
        return $this->hasMany(Finivacacional::class);
    }
}
