<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSobraPt extends Model
{
    use HasFactory;
    public function Item(){
        return $this->belongsTo(Item::class);
    }

    public function Pt(){
        return $this->belongsTo(Pt::class);
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
