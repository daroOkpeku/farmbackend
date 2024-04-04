<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reproduction extends Model
{
    use HasFactory;

    protected $fillable = [

        'reproductionid',
       'animal_animalid',
       'breedingdate',
       'pregnancycheckdate',
        'outcome',
       'birtheventdate',
    ];
}
