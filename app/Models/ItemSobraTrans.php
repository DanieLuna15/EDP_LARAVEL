<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSobraTrans extends Model
{
    use HasFactory;
    public function Item(){
        return $this->belongsTo(Item::class);
    }

    public function transformacionLote()
    {
        return $this->belongsTo(TransformacionLote::class, 'trans_id');
    }
    public function Pt()
    {
        return $this->belongsTo(Pt::class, 'pt_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
