<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaccinationschedule extends Model
{
    use HasFactory;

    protected $fillable = [

       'vaccinationscheduleid',
       'breed_breedid',
       'vaccinename',
       'frequency',
       'dose',
        'manufacturer',
       'statutory_requirement',
       'additional_notes'
    ];
}


// -  'vaccinationscheduleid'=>vaccinations.vet_council_number,
// --        'species_speciesid'=>vaccinations.tag_id,
// --        'breed_breedid'=>animal_breed_clone.id,
// --        'vaccinename'=>vaccinations.drug,
// --        'frequency'=>vaccinations.frequency,
// --        'dose'=>vaccinations.dosage,
// --         'manufacturer'=>veterinary_doctors.hospital_name,
// --        'statutory_requirement'=> Nothing
// --        'additional_notes'=>vaccinations.notes
