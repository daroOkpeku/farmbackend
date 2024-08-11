<?php

namespace App\Http\Repository;

use App\Http\Repository\Contracts\TestInterface;
use App\Jobs\ProcessFinanceRecord;
use App\Jobs\ProcessFinanceRecordEdit;
use App\Jobs\ProcessHealthCreate;
use App\Jobs\ProcessHealthEdit;
use App\Jobs\ProcessProductionCreate;
use App\Jobs\ProcessProductionEdit;
use App\Models\Animal_livestock;
use App\Models\Animal;
use App\Models\Document;
use App\Models\Feed;
use App\Models\FinancialRecord;
use App\Models\HealthRecord;
use App\Models\Production;

class TestRepository implements TestInterface
{

    public function info($request)
    {
        dd($request->all());
    }

    public function deleteAnimal($id)
    {
        try {
            $animal = Animal_livestock::findOrFail($id);
            $animal->delete();
            return response()->json(['success' => 'Animal deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Animal not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while trying to delete the animal'], 500);
        }
    }

    public function healthcreate($request)
    {

        $check_tag =  Animal_livestock::where('tag_id', $request->tagnumber)->first();
        if ($check_tag) {
            $animalId = optional(Animal::where('name', $check_tag->name)->first())->animalid;
          $sch_number = rand(0, 10000);
          $health =  HealthRecord::create([
            'recordid'=>$sch_number,
            'animal_animalid'=>$animalId,
            'vacation_date'=> $request->vacation_date,
             'vaccine_name'=> $request->vaccine_name,
             'treatments'=>$request->treatments,
             'treatments_date'=> $request->treatments_date,
             'illness'=>$request->illness,
             'dose'=>$request->dose,
             'cost'=>$request->cost,
             'treated_by_vcn_number'=>$request->treated_by_vcn_number,
             'status'=>$request->status,
             'tagnumber'=>$request->tagnumber,
            'details'=>'nothing'

        ]);
         ProcessHealthCreate::dispatchAfterResponse($health);

            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber, 'id'=>$health->id], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function healthedit($request)
    {
        $check_tag = HealthRecord::where(['tagnumber'=>$request->tagnumber, 'id'=>$request->id])->first();
        if ($check_tag) {
            ProcessHealthEdit::dispatch($request->vacation_date, $request->vaccine_name, $request->treatments, $request->treatments_date, $request->illness, $request->dose, $request->cost, $request->treated_by_vcn_number, $request->status, $request->tagnumber, $request->id);
            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function productioncreate($request)
    {
        // $production = Production::where("tagnumber", $request->tagnumber)->first();
        $check_tag = Animal_livestock::where('tag_id', $request->tagnumber)->first();
        if ( $check_tag) {
            $animal = Animal::where('name', $check_tag->name)->first();
            $random_number = rand(0, 10000);
            $production = Production::create([
                'productionid'=>$random_number,
                'animal_animalid'=>$animal->animalid,
                'date_of_producation'=>$request->date,
                'production_type'=>$request->production_type,
                   'quantity'=>$request->quantity,
                  'weight'=>$request->weight,
                  'production_cycle'=>$request->production_cycle,
                    'yield'=>$request->yield,
                    'cost'=>$request->cost,
                    'disorders'=> $request->disorders,
                    'estrus_cycle_start_date'=> $request->estrus_cycle_start_date,
                    'estrus_cycle_end_date'=>$request->estrus_cycle_end_date,
                    'tagnumber'=>$request->tagnumber
                ]);


       ProcessProductionCreate::dispatchAfterResponse(
             $production
            );

            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber, 'id'=>$production->id], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function productionedit($request)
    {
        $production = Production::where(["tagnumber"=>$request->tagnumber, 'id'=>$request->id])->first();
        if ($production) {
            ProcessProductionEdit::dispatch(
                $request->production_type,
                $request->weight,
                $request->date,
                $request->production_cycle,
                $request->yield,
                $request->cost,
                $request->disorders,
                $request->estrus_cycle_start_date,
                $request->estrus_cycle_end_date,
                $request->tagnumber,
                $request->quantity,
                $request->id
            );
            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function financerecordcreate($request)
    {
        $finance = Animal_livestock::where(['tag_id'=>$request->tagnumber])->first();
        if ($finance) {
            $finance =  FinancialRecord::create([
                'tagnumber'=>$request->tagnumber,
                'production_type'=>$request->production_type,
                'date_fin'=> $request->date_fin,
                'items'=> $request->items,
                'input_cost'=>$request->input_cost,
                 'yield'=> $request->yield,
                 'current_value'=>$request->current_value,
                 'revenue'=>$request->revenue,
                 'profit'=>$request->profit
            ]);
         ProcessFinanceRecord::dispatchAfterResponse(
            $finance
            );

            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber, 'id'=>$finance->id], 200);
        }else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function financerecordedit($request){
        $finance = FinancialRecord::where(['tagnumber'=>$request->tagnumber, 'id'=>$request->id])->first();
       if($finance) {
       ProcessFinanceRecordEdit::dispatch(
        $request->tagnumber,
        $request->production_type,
        $request->date_fin,
        $request->items,
        $request->input_cost,
        $request->yield,
        $request->current_value,
        $request->revenue,
        $request->profit,
        $request->id
       );
       return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
       }
       else {
        return response()->json(['error' => 'please check your input'], 200);
    }
    }

    public function feeddelete($id){
       $feed = Feed::find($id);

       if($feed){
        $feed->delete();
        return response()->json(['success' => 'successful']);
       }else{
        return response()->json(['error' => 'please check your input'], 200);
       }
    }

    public function financedelete($id){
        $finance =  FinancialRecord::find($id);
    if($finance){
     $finance->delete();
     return response()->json(['success' => 'successful']);
    }else{
    return response()->json(['error' => 'please check your input'], 200);
    }
    }

    public function healthrecordsdelete($id){
        $healthrecords = HealthRecord::find($id);
        if($healthrecords){
            $healthrecords->delete();
            return response()->json(['success' => 'successful']);
           }else{
           return response()->json(['error' => 'please check your input'], 200);
           }
    }

    public function productiondelete($id){
      $production = Production::find($id);
      if($production){
        $production->delete();
        return response()->json(['success' => 'successful']);
       }else{
       return response()->json(['error' => 'please check your input'], 200);
       }
    }

    public function documentdelete($id){
        $document = Document::find($id);
        if($document){
          $document->delete();
          return response()->json(['success' => 'successful']);
         }else{
         return response()->json(['error' => 'please check your input'], 200);
         }
    }
}
