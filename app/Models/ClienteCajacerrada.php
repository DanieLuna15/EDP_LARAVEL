<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteCajacerrada extends Model
{
    use HasFactory;
    public function ProductoPrecio(){
        return $this->belongsTo(ProductoPrecio::class);
    }
}
