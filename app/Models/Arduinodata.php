<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arduinodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'voltage' ,
        'current' ,
        'frequency',
        'power',
        'energy' ,
        'runtime',
        'temperature',
        'oil_level',
        'oil_quality',
        'fuel_level',
        'rpm' ,
        'gyration',
        'health_status',
        'arduinodatas_id'
    ];
}
