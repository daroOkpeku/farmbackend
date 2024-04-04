<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
       'productionid',
        'animal_animalid',
        'date_of_producation',
        'production_type',
           'quantity',
          'weight',
    ];
}
