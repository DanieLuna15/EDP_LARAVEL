<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaItemsPt extends Model
{
    use HasFactory;
    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
    public function Pt()
    {
        return $this->belongsTo(Pt::class);
    }
    public function Venta()
    {
        return $this->belongsTo(Venta::class)->with(['Cliente','User']);
    }
    public function ItemsPt()
    {
        return $this->belongsTo(ItemsPt::class);
    }
}
