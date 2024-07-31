<?php

namespace App\Http\Resources;

use App\Models\Farm;
use App\Models\HealthRecord;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Animalresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
         'id'=>$this->id,
         'tagnumber'=>$this->tagnumber,
         'date_of_birth'=>$this->date_of_birth,
         'sex'=>$this->sex,
          'breeddata'=>Breedextendresources::make($this->whenLoaded('animalData')),
        ];
    }
}
