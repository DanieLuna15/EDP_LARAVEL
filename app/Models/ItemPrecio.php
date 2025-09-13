<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPrecio extends Model
{
    use HasFactory;
    public function Item()
    {
        return $this->belongsTo(Item::class)->where('estado',1);
    }
}
