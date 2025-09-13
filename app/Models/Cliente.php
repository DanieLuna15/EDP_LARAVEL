<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public function ClienteCajacerradas(){
        return $this->hasMany(ClienteCajacerrada::class)->with('ProductoPrecio')->where('estado',1);
    }
    public function ClientePps(){
        return $this->hasMany(ClientePp::class)->with('Item')->where('estado',1);
    }
    public function ClientePts(){
        return $this->hasMany(ClientePt::class)->with('Item')->where('estado',1);
    }
    public function Documento(){
        return $this->belongsTo(Documento::class);
    }
    public function Tipocliente(){
        return $this->belongsTo(Tipocliente::class);
    }
    public function Tipopago(){
        return $this->belongsTo(Tipopago::class);
    }
    public function CintaCliente(){
        return $this->belongsTo(CintaCliente::class);
    }
    public function ZonaDespacho(){
        return $this->belongsTo(ZonaDespacho::class);
    }
    public function TipoNegocio(){
        return $this->belongsTo(TipoNegocio::class);
    }
    public function FormaPedido(){
        return $this->belongsTo(FormaPedido::class);
    }
    public function ClienteFiles(){
        return $this->hasMany(ClienteFile::class)->with(['File','Tipoarchivo'])->where('estado',1);
    }
    public function AcuerdoCliente(){
        return $this->belongsTo(AcuerdoCliente::class);
    }
    public function VentaCajas(){
        return $this->hasMany(VentaCaja::class)->where('estado',1);
    }
    public function EntregaCajas(){
        return $this->hasMany(EntregaCaja::class, 'cliente_id')->where('estado',1);
    }
    public function Ventas()
    {
        return $this->hasMany(Venta::class, 'cliente_id'); // Asegúrate de que el campo sea correcto
    }
}
