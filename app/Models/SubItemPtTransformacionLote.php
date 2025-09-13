<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubItemPtTransformacionLote extends Model
{
    use HasFactory;
    public function Item()
    {
        return $this->belongsTo(Item::class,'item_id');
    }
    public function SubItem()
    {
        return $this->belongsTo(Item::class,'subitem_id');
    }

    public function Pt()
    {
        return $this->belongsTo(Pt::class,'pt_id');
    }

    public function TransformacionLote()
    {
        return $this->belongsTo(TransformacionLote::class,'transformacion_lote_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
