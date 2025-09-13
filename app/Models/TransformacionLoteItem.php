<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformacionLoteItem extends Model
{
    use HasFactory;

    public function TransformacionLote()
    {
        return $this->belongsTo(TransformacionLote::class);
    }

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
    public function Pt()
    {
        return $this->belongsTo(Pt::class);
    }

}
