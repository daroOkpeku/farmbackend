<?php

namespace App\Http\Repository;

use App\Models\Farm;
use Illuminate\Support\Facades\DB;
use App\Models\Farmdetails;
use App\Models\Species;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\HealthRecord;
use App\Models\Reproduction;
use App\Models\Production;
use App\Models\Feed;
use App\Models\FeedingSchedule;
use App\Models\FinancialRecord;
use App\Models\genealogy;
use App\Models\AnimalLocation;
use App\Http\Repository\Contracts\FarmInterface;
use App\Jobs\ProcessAnimalDetails;
use App\Jobs\ProcessAnimalLocation;
use App\Jobs\ProcessBreed;
use App\Jobs\ProcessEditAnimalDetails;
use App\Jobs\ProcessFarmInfo;
use App\Jobs\ProcessFeed;
use App\Jobs\ProcessFeedCreate;
use App\Jobs\ProcessFeedEdit;
use App\Jobs\ProcessFeedSchedule;
use App\Jobs\ProcessFinancialRecord;
use App\Jobs\ProcessGenealogy;
use App\Jobs\ProcessHealthRecord;
use App\Jobs\ProcessProduction;
use App\Jobs\ProcessReproduction;
use App\Jobs\ProcessSpecial;
use App\Models\Animal_livestock;
use Illuminate\Support\Facades\Cache;
use ImageKit\ImageKit;

class FarmRepository implements FarmInterface
{


    public function farminfo($request)
    {

        try {
            $farm = null;
            DB::transaction(function () use ($request) {
                $farm = Farm::create([
                    'animalid' => $request->animalid,
                    'farmname' => $request->farmname,
                    'farmid' => $request->farmid,
                    'location' => $request->location,
                    'owner' => $request->owner,
                    'size' => $request->size,
                    'farmtype' => $request->farmtype,
                ]);


                Farmdetails::create([
                    'farm_farmid' => $farm->id,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'website' => $request->website,
                ]);
            });

            ProcessFarmInfo::dispatchAfterResponse($farm);
            return response()->json(['success' => 'successfully created'], 200);
        } catch (\Throwable   $e) {
            return response()->json(['error' => "something went wrong"], 500);
        }
    }




    public function animaldetails($request)
    {
        $check_tag = Animal_livestock::where('tag_id', $request->tagnumber)->exists();
        if ($check_tag) {
            return response()->json(['error' => 'this tag number exist alreadly'], 202);
        } else {
            $farm = Farm::where('farmname', $request->farmname)->first();
            if ($farm) {
                ProcessAnimalDetails::dispatchAfterResponse($request->animal_name,  $request->breed, $request->tagnumber, $request->sex, $request->age, $request->weight, $request->health_status, $farm->farmid);

                return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
            } else {
                return response()->json(['error' => 'please input correct details'], 200);
            }
        }
    }


    public function editanimaldetails($request)
    {
        $check_tag = Animal_livestock::where('tag_id', $request->tagnumber)->exists();
        if ($check_tag) {
            try {
                $farm = Farm::where('farmname', $request->farmname)->first();
                ProcessEditAnimalDetails::dispatchAfterResponse($request->animal_name,  $request->breed, $request->tagnumber, $request->sex, $request->age, $request->weight, $request->health_status, $farm->farmid);
                return response()->json(['success' => 'successful edited', 'tagnumber' => $request->tagnumber], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => 'please input correct details'], 200);
            }
        }
    }



    public function species($request)
    {
        ProcessSpecial::dispatchAfterResponse($request->speciesid, $request->speciesname);
        return response()->json(["success" => "successful"], 200);
    }


    public function breed($request)
    {
        ProcessBreed::dispatchAfterResponse($request->breedid, $request->breedname, $request->species_speciesid);
        return response()->json(['success' => "successful"], 200);
    }


    public function healthrecord($request)
    {
        $animal = Animal::where('animalid', $request->animal_animalid)->first();
        if ($animal) {
            ProcessHealthRecord::dispatchAfterResponse($request->recordid, $animal->id, $request->event_date, $request->type_event, $request->details);
            return response()->json(["success" => "successful"], 200);
        } else {
            return response()->json(['error' => 'please input correct details'], 404);
        }
    }


    public function reproduction($request)
    {
        $animal = Animal::where('animalid', $request->animal_animalid)->first();
        if ($animal) {
            ProcessReproduction::dispatchAfterResponse($request->reproductionid, $animal->id, $request->breedingdate, $request->pregnancycheckdate, $request->outcome, $request->birtheventdate);
            return response()->json(["success" => "successful"], 200);
        } else {
            return response()->json(['error' => 'please input correct details'], 404);
        }
    }


    public function production($request)
    {
        $animal = Animal::where('animalid', $request->animal_animalid)->first();
        if ($animal) {
            ProcessProduction::dispatchAfterResponse($request->productionid, $animal->id, $request->date_of_producation, $request->production_type, $request->quantity, $request->weight);
            return response()->json(["success" => "successfull"], 200);
        } else {
            return response()->json(['error' => 'please input correct details'], 404);
        }
    }



    public function feed($request)
    {
        ProcessFeed::dispatchAfterResponse($request->feedid, $request->feedtype, $request->feeddetails);
        return response()->json(["success" => "successfull"], 200);
    }



    public function feedingschedule($request)
    {
        $animal = Animal::where('animalid', $request->animal_animalid)->first();
        $feed = Feed::where('feedid', $request->feed_feedid)->first();
        if ($animal && $feed) {

            ProcessFeedSchedule::dispatchAfterResponse($request->scheduleid, $animal->id, $feed->id, $request->date_of_feeding, $request->quantity);
            return response()->json(["success" => "successfull"], 200);
        } else {
            return response()->json(['error' => 'please input correct details'], 404);
        }
    }


    public function financialrecord($request)
    {
        $farm = Farm::where('farmid', $request->farm_farmid)->first();
        if ($farm) {

            ProcessFinancialRecord::dispatchAfterResponse($request->recordid, $farm->id, $request->type_of_finance, $request->amount, $request->date_of_finance, $request->details);
            return response()->json(["success" => "successfull"], 200);
        } else {
            return response()->json(['error' => 'please input correct details'], 404);
        }
    }

    public function animallocation($request)
    {
        $farm = Farm::where('farmid', $request->farm_farmid)->first();
        $animal = Animal::where('animalid', $request->animal_animalid)->first();
        if ($farm && $animal) {
            ProcessAnimalLocation::dispatchAfterResponse($request->locationid, $farm->id, $animal->id, $request->locationdetails, $request->datemovedin, $request->datemovedout);

            return response()->json(["success" => "successfull"], 200);
        } else {
            return response()->json(['error' => 'please input correct details'], 404);
        }
    }


    public function genealogy($request)
    {
        $animal = Animal::where('animalid', $request->animal_animalid)->first();
        if ($animal) {

            ProcessGenealogy::dispatchAfterResponse($request->genealogyid, $animal->id, $request->parenttype, $request->parentanimalid);
            return response()->json(["success" => "successfull"], 200);
        }
    }

    public function uploadImage($image)
    {

        $imageKit = new ImageKit(
            "public_IHlr65pELltC8TesgCq2+rPenBA=",
            "private_JNStaABpZ3j2HqOlsNyL8Erc2Og=",
            "https://ik.imagekit.io/ca4ajrkzu"
        );
        $fileContent = $image;
        $uploadFile = $imageKit->uploadFile([
            'file' => base64_encode($fileContent),
            'fileName' => 'new-file'
        ]);
        return $uploadFile->result->url;
    }


    public function photo($request)
    {
        $check_tag = Animal_livestock::where('tag_id', $request->tagnumber)->first();
        if ($check_tag) {
            $fileContent = file_get_contents($request->file('image')->getRealPath());
            $imglink = $this->uploadImage($fileContent);
            $check_tag->image = $imglink;
            $check_tag->save();
            return response()->json(['success' => 'your image have been updated', 'image' => $imglink], 200);
        } else {
            return response()->json(['' => 'please check your input'], 200);
        }
    }

    public function feedcreate($request)
    {
        $random_number = rand(0, 10000);
        $sch_number = rand(0, 10000);
        $feed =  Feed::where('feedid', $random_number)->first();
        $feedsch = FeedingSchedule::where('scheduleid', $sch_number)->first();
        $check_tag =  Animal_livestock::where('tag_id', $request->tagnumber)->first();
        if (!$feed && !$feedsch && !$check_tag) {
            $animal = optional(Animal::where('name', $check_tag->name)->first())->animalid;
            ProcessFeedCreate::dispatch($request->tagnumber, $request->feedtype, $request->schedule, $request->qty, $random_number,  $sch_number, $request->cost, $animal, $request->feeddetail, $request->producationtype, $request->ration, $request->ration_composition, $request->disorders);
            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function feededit($request)
    {

        ProcessFeedEdit::dispatch($request->tagnumber, $request->feedtype, $request->schedule, $request->qty, $request->feedid, $request->cost, $request->feeddetail, $request->producationtype, $request->ration, $request->ration_composition, $request->disorders);
        return response()->json(['success' => 'Edit successful', 'tagnumber' => $request->tagnumber], 200);
    }



}
