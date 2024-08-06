<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'recordid',
        'animal_animalid',
        'vacation_date',
         'vaccine_name',
         'treatments',
         'treatments_date',
         'illness',
         'dose',
         'cost',
         'treated_by_vcn_number',
         'status',
         'tagnumber',
        'details'
    ];

    public function healthConnect(){
        return $this->belongsTo(Animal_livestock::class, 'tagnumber', 'tag_id');
    }
}
