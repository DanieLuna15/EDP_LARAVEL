<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'cobranza_first_printed_at' => 'datetime',
        'ticket_cobranza_first_printed_at' => 'datetime',
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Preventista()
    {
        return $this->belongsTo(User::class);
    }
    public function Distribuidor()
    {
        return $this->belongsTo(User::class);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function Chofer()
    {
        return $this->belongsTo(Chofer::class);
    }
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class)->with(['CintaCliente','ZonaDespacho','TipoNegocio','FormaPedido','Tipopago']);
    }
    public function VentaDetallePps()
    {
        return $this->hasMany(VentaDetallePp::class)->with('Item');
    }
    public function VentaAcuerdos()
    {
        return $this->hasMany(VentaAcuerdo::class);
    }
    public function VentaTransformacions()
    {
        return $this->hasMany(VentaTransformacion::class)->with('Subitem')->where('estado',1);
    }
    public function VentaItemsPts()
    {
        return $this->hasMany(VentaItemsPt::class)->with('Item');
    }
    public function LoteDetalleVentas()
    {
        return $this->hasMany(LoteDetalleVenta::class)->with(['LoteDetalle','LoteDetalleHistorial']);
    }
    public function arqueoVenta()
    {
        return $this->hasMany(ArqueoVenta::class, 'venta_id')->latest();  // Usamos `hasMany` ya que una venta puede tener varios arqueos
    }
    public function VentaCaja(){
        return $this->hasOne(VentaCaja::class);
    }
    public function VentaGastos()
    {
        return $this->hasMany(VentaGasto::class);
    }
    public function Tipopago(){
        return $this->belongsTo(Tipopago::class, 'metodo_pago');
    }
}
