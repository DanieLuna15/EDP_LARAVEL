<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescomponerTransformacionLote extends Model
{
    use HasFactory;

    public function TransformacionLote(){
        return $this->belongsTo(TransformacionLote::class);
    }

    public function SubItem(){
        return $this->belongsTo(Item::class,'subitem_id')->where('estado',1);
    }
}
