<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransEspecial extends Model
{
    use HasFactory;
    public function TransEspecialItems()
    {
        return $this->hasMany(TransEspecialItem::class)->where('estado',1);
    }

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
}
