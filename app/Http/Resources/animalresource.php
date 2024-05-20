<?php

namespace App\Http\Resources;

use App\Models\Farm;
use App\Models\HealthRecord;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class animalresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'animalid'=>$this->animalid,
             "animal_name"=>optional(Species::where("specie_speciesid", $this->specie_speciesid)->first())->speciesname,
            //  "size"=>optional(Farm::where("animalid", $this->specie_speciesid)->first())->speciesname,
             'status'=>optional(HealthRecord::where("animal_animalid", $this->animalid)->first())->type_event,
               'sex'=>$this->sex,
               'date_of_birth'=>$this->date_of_birth,
        ];
    }
}
