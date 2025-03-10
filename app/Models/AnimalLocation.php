<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalLocation extends Model
{
    use HasFactory;

    protected $fillable = [
       'locationid',
       'farm_farmid',
        'animal_animalid',
       'locationdetails',
         'datemovedin',
         'datemovedout',
    ];
}
