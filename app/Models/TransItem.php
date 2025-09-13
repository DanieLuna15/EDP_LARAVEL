<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransItem extends Model
{
    protected $table = 'trans_items';
    use HasFactory;
    public function TransItemDetalles()
    {
        return $this->hasMany(TransItemDetalle::class)->where('estado',1);
    }

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
}
