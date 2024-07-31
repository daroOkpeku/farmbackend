<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class AnimalExtendresources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentDate = Carbon::now();

        // Calculate the difference
        $diff = $currentDate->diff($this->date_of_birth);

        // Extract years and months

        $months = $diff->m;
        $word =  $months > 0?"months":"month" ;
        return [
            'animalid'=>$this->animalid,
             "tagnumber"=>$this->tagnumber,
             'breeddata'=>Breedextendresources::make($this->whenLoaded('animalData')),
             'sex'=>$this->sex,
             'date_of_birth'=>Carbon::parse($this->date_of_birth)->age." years",
        ];
    }
}
