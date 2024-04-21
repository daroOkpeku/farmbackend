<?php
namespace App\Http\Controllers;

use App\Http\Requests\animaldetailsreq;
use App\Http\Requests\animallocationreq;
use App\Http\Requests\breedreq;
use App\Http\Requests\farminforeq;
use App\Http\Requests\feedingschedulereq;
use App\Http\Requests\feedreq;
use App\Http\Requests\financialrecordreq;
use App\Http\Requests\healthrecordreq;
use App\Http\Requests\productionreq;
use App\Http\Requests\reproductionreq;
use App\Http\Requests\speciesreq;
use App\Models\Animal;
use App\Models\AnimalLocation;
use App\Models\Breed;
use App\Models\Farm;
use App\Models\Farmdetails;
use App\Models\Feed;
use App\Models\FeedingSchedule;
use App\Models\FinancialRecord;
use App\Models\genealogy;
use App\Models\HealthRecord;
use App\Models\Production;
use App\Models\Reproduction;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

     public function farminfo(farminforeq $request){
        
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


     public function animaldetails(animaldetailsreq $request){
        $specie = optional(Species::where('speciesid', $request->specie_speciesid))->id??"";
        if($specie){
            Animal::create([
                "animalid"=>$request->animalid,
                "specie_speciesid"=>$specie,
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


     public function species(speciesreq $request){
         Species::create([
            "speciesid"=>$request->speciesid,
            "speciesname"=>$request->speciesname
         ]);
         return response()->json(["success"=>"successful"],200);
     }

     public function breed(breedreq $request){
         Breed::create([
            "breedid"=>$request->breedid,
            "breedname"=>$request->breedname,
            "species_speciesid"=>$request->species_speciesid
         ]);
         return response()->json(['success'=>"successful"],200);
     }

     public function healthrecord(healthrecordreq $request){
       $animal = optional(Animal::where('animalid', $request->animal_animalid))->id;
       if($animal){
        HealthRecord::create([
            'recordid'=>$request->recordid,
            'animal_animalid'=>$animal,
            'event_date'=>$request->event_date,
             'type_event'=>$request->type_event,
            'details'=>$request->details
        ]);
        return response()->json(["success"=>"successful"],200);
       }else{
        return response()->json(['error' => 'please input correct details'], 404);

       }
     
     }

      public function reproduction(reproductionreq $request){
        $animal = optional(Animal::where('animalid', $request->animal_animalid))->id;
        if($animal){
            Reproduction::create([
                'reproductionid'=>$request->reproductionid,
                'animal_animalid'=>$animal,
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

      public function production(productionreq $request){
        $animal = optional(Animal::where('animalid', $request->animal_animalid))->id;
        if($animal){
         Production::create([
            'productionid'=>$request->productionid,
            'animal_animalid'=>$animal,
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

      public function feed(feedreq $request){
        Feed::create([
            'feedid'=>$request->feedid,
            'feedtype'=>$request->feedtype,
             'feeddetails'=>$request->feeddetails
        ]);
        return response()->json(["success"=>"successfull"],200);
      }

      public function feedingschedule(feedingschedulereq $request){
        $animal = optional(Animal::where('animalid', $request->animal_animalid))->id;
        $feed = optional(Feed::where('feedid', $request->feed_feedid))->id??"";
        if($animal){
        FeedingSchedule::create([
            'scheduleid'=>$request->scheduleid,
            'animal_animalid'=>$animal,
            'feed_feedid'=>$feed,
             'date_of_feeding'=>$request->date_of_feeding,
               'quantity'=>$request->quantity
        ]);
        return response()->json(["success"=>"successfull"],200);
     }else{
        return response()->json(['error' => 'please input correct details'], 404);
       }
      }

      public function financialrecord(financialrecordreq $request){
       $farm = optional(Farm::where('farmid', $request->farm_farmid))->id??"";
       if($farm){
        FinancialRecord::create([
            'recordid'=>$request->recordid,
            'farm_farmid'=>$farm,
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

      public function animallocation(animallocationreq $request){
        $farm = optional(Farm::where('farmid', $request->farm_farmid))->id??"";
        $animal = optional(Animal::where('animalid', $request->animal_animalid))->id??"";
         if($farm && $animal){
            AnimalLocation::create([
                'locationid'=>$request->locationid,
                'farm_farmid'=>$farm,
                 'animal_animalid'=>$animal,
                'locationdetails'=>$request->locationdetails,
                  'datemovedin'=>$request->datemovedin,
                  'datemovedout'=>$request->datemovedout,
            ]);
            return response()->json(["success"=>"successfull"],200);
         }else{
            return response()->json(['error' => 'please input correct details'], 404);
           }
      }

      public function genealogy(Request $request){
        $animal = optional(Animal::where('animalid', $request->animal_animalid))->id??"";
        if($animal){
            genealogy::create([
                'genealogyid'=>$request->genealogyid,
                'animal_animalid'=>$animal,
               'parenttype'=>$request->parenttype,
                'parentanimalid'=>$request->parentanimalid
            ]);
            return response()->json(["success"=>"successfull"],200);
        }
     
      }
}



