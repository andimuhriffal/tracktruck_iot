<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelLevel extends Model
{
    protected $fillable = [
        'jarak', 
        'persentase_bahan_bakar',
    ];
}
