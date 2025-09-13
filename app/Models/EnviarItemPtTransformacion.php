<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnviarItemPtTransformacion extends Model
{
    use HasFactory;

    public function Pt()
    {
        return $this->belongsTo(Pt::class);
    }

    public function Item()
    {
        return $this->belongsTo(Item::class);
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
