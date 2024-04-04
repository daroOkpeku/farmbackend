<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genealogy extends Model
{
    use HasFactory;

    protected $fillable = [

     'genealogyid',
        'animal_animalid',
       'parenttype',
        'parentanimalid'
    ];
}
