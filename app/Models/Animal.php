<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable =[
    'animalid',
       'breed_breedid',
        'tagnumber',
         'sex',
         'date_of_birth',
       'acquisition_date'
    ];

    public function animalData(){
        return $this->belongsTo(Breed::class, 'breed_breedid', 'breedid');
    }
}
