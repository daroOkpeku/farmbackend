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
          'production_cycle',
            'yield',
            'cost',
            'disorders',
            'estrus_cycle_start_date',
            'estrus_cycle_end_date',
            'tagnumber'
    ];
}
