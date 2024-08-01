<?php

namespace App\Http\Resources;

use App\Models\Farm;
use App\Models\HealthRecord;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class Animalresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //         // Convert the date of birth to a Carbon instance
        // $birthDate = Carbon::parse($this->date_of_birth);

        // // Get the current date
        // $currentDate = Carbon::now();

        // // Calculate the difference
        // $diff = $currentDate->diff($birthDate);

        // // Extract years and months
        // $years = $diff->y;
        // $months = $diff->m;

        // // Format the age string
        // $ageString = $years . " yrs " . $months . " mos";

        return [
        'id'=>$this->id,
        'name'=>$this->name,
        'sex'=>$this->sex,
        'image'=>$this->image,
        'breed'=>$this->breed,
        'weight'=>$this->weight,
        'tag_id'=>$this->tag_id,
        'health_status'=>$this->health_status,
        'farm_farmid'=>Breedextendresources::make($this->whenLoaded('FarmConnect'))
        ];
    }
}
