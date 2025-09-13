<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescomponerPt extends Model
{
    use HasFactory;
    public function ItemsPts()
    {
        return $this->hasMany(ItemsPt::class, 'descomponer_pt_id');
    }
}
