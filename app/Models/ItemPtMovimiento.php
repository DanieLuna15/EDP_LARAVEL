<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPtMovimiento extends Model
{
    use HasFactory;
    public function Item(){
        return $this->belongsTo(Item::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
