<?php
// app/Models/Detection.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_detected',
        'passenger_detected',
        'belt_status',
    ];
}
