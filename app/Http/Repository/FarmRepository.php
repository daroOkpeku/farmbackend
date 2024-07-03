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

class FarmRepository implements FarmInterface{


    public function farminfo($request){

        try {
           DB::transaction(function() use($request){
               $farm = Farm::create([
              'animalid'=>$request->animalid,
              'farmname'=>$request->farmname,
              'farmid'=>$request->farmid,
              'location'=>$request->location,
              'owner'=>$request->owner,
              'size'=>$request->size,
              'farmtype'=>$request->farmtype,
               ]);


           Farmdetails::create([
                        'farm_farmid'=>$farm->id,
                        'phone'=>$request->phone,
                        'email'=>$request->email,
                        'website'=>$request->website,
                      ]);
          });
          return response()->json(['success'=>'successfully created'],200);

        } catch (\Throwable   $e) {
           return response()->json(['error'=>"something went wrong"],500);
        }

        }




        public function animaldetails($request){
            $specie = Species::where('speciesid', $request->specie_speciesid)->first();
            if($specie){
                Animal::create([
                    "animalid"=>$request->animalid,
                    "specie_speciesid"=>$specie->id,
                    "breed_breedid"=>$request->breed_breedid,
                    "tagnumber"=>$request->tagnumber,
                    "sex"=>$request->sex,
                    "date_of_birth"=>$request->date_of_birth,
                    "acquisition_date"=>$request->acquisition_date,
                ]);
               return response()->json(['success'=>'successful'],200);
            }else{
                return response()->json(['error' => 'Species not found'], 404);
            }

         }



         public function species($request){
            Species::create([
               "speciesid"=>$request->speciesid,
               "speciesname"=>$request->speciesname
            ]);
            return response()->json(["success"=>"successful"],200);
        }


        public function breed($request){
            Breed::create([
               "breedid"=>$request->breedid,
               "breedname"=>$request->breedname,
               "species_speciesid"=>$request->species_speciesid
            ]);
            return response()->json(['success'=>"successful"],200);
        }


        public function healthrecord($request){
            $animal = Animal::where('animalid', $request->animal_animalid)->first();
            if($animal){
             HealthRecord::create([
                 'recordid'=>$request->recordid,
                 'animal_animalid'=>$animal->id,
                 'event_date'=>$request->event_date,
                  'type_event'=>$request->type_event,
                 'details'=>$request->details
             ]);
             return response()->json(["success"=>"successful"],200);
            }else{
             return response()->json(['error' => 'please input correct details'], 404);

            }
          }


          public function reproduction($request){
            $animal = Animal::where('animalid', $request->animal_animalid)->first();
            if($animal){
                Reproduction::create([
                    'reproductionid'=>$request->reproductionid,
                    'animal_animalid'=>$animal->id,
                    'breedingdate'=>$request->breedingdate,
                    'pregnancycheckdate'=>$request->pregnancycheckdate,
                     'outcome'=>$request->outcome,
                    'birtheventdate'=>$request->birtheventdate,
                ]);
                return response()->json(["success"=>"successful"],200);
            }else{
                return response()->json(['error' => 'please input correct details'], 404);
            }

          }


          public function production($request){
            $animal = Animal::where('animalid', $request->animal_animalid)->first();
            if($animal){
             Production::create([
                'productionid'=>$request->productionid,
                'animal_animalid'=>$animal->id,
                'date_of_producation'=>$request->date_of_producation,
                'production_type'=>$request->production_type,
                   'quantity'=>$request->quantity,
                  'weight'=>$request->weight,
             ]);
             return response()->json(["success"=>"successfull"],200);
            }else{
                return response()->json(['error' => 'please input correct details'], 404);
            }
          }



            public function feed( $request){
                Feed::create([
                    'feedid'=>$request->feedid,
                    'feedtype'=>$request->feedtype,
                    'feeddetails'=>$request->feeddetails
                ]);
                return response()->json(["success"=>"successfull"],200);
            }



            public function feedingschedule($request){
                $animal = Animal::where('animalid', $request->animal_animalid)->first();
                $feed = Feed::where('feedid', $request->feed_feedid)->first();
                if($animal && $feed){
                FeedingSchedule::create([
                    'scheduleid'=>$request->scheduleid,
                    'animal_animalid'=>$animal->id,
                    'feed_feedid'=>$feed->id,
                     'date_of_feeding'=>$request->date_of_feeding,
                       'quantity'=>$request->quantity
                ]);
                return response()->json(["success"=>"successfull"],200);
             }else{
                return response()->json(['error' => 'please input correct details'], 404);
               }
              }


              public function financialrecord($request){
                $farm = Farm::where('farmid', $request->farm_farmid)->first();
                if($farm){
                 FinancialRecord::create([
                     'recordid'=>$request->recordid,
                     'farm_farmid'=>$farm->id,
                      'type_of_finance'=>$request->type_of_finance,
                      'amount'=>$request->amount,
                    'date_of_finance'=>$request->date_of_finance,
                      'details'=>$request->details
                    ]);
                    return response()->json(["success"=>"successfull"],200);
                }else{
                 return response()->json(['error' => 'please input correct details'], 404);
                }
               }

               public function animallocation($request){
                $farm = Farm::where('farmid', $request->farm_farmid)->first();
                $animal = Animal::where('animalid', $request->animal_animalid)->first();
                 if($farm && $animal){
                    AnimalLocation::create([
                        'locationid'=>$request->locationid,
                        'farm_farmid'=>$farm->id,
                         'animal_animalid'=>$animal->id,
                        'locationdetails'=>$request->locationdetails,
                          'datemovedin'=>$request->datemovedin,
                          'datemovedout'=>$request->datemovedout,
                    ]);
                    return response()->json(["success"=>"successfull"],200);
                 }else{
                    return response()->json(['error' => 'please input correct details'], 404);
                   }
              }


              public function genealogy($request){
                $animal = Animal::where('animalid', $request->animal_animalid)->first();
                if($animal){
                    genealogy::create([
                        'genealogyid'=>$request->genealogyid,
                        'animal_animalid'=>$animal->id,
                       'parenttype'=>$request->parenttype,
                        'parentanimalid'=>$request->parentanimalid
                    ]);
                    return response()->json(["success"=>"successfull"],200);
                }

              }


}
