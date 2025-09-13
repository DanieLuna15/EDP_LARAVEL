<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsPt extends Model
{
    use HasFactory;
    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function PpEmisor()
    {
        return $this->belongsTo(Pp::class, 'pp_emisor_id');
    }

    public function PtEmisor()
    {
        return $this->belongsTo(Pt::class, 'pt_emisor_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
