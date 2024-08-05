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

    public function deleteAnimal($request)
    {
        try {
            $animal = Animal_livestock::findOrFail($request->id);
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
        $check_tag = HealthRecord::where('tagnumber', $request->tagnumber)->first();
        if (!$check_tag) {
            $animalId = optional(Animal::where('name', $check_tag->name)->first())->animalid;
            ProcessHealthCreate::dispatch($request->vacation_date, $request->vaccine_name, $request->treatments, $request->treatments_date, $request->illness, $request->dose, $request->cost, $request->treated_by_vcn_number, $request->status, $animalId, $request->tagnumber);
            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function healthedit($request)
    {
        $check_tag = HealthRecord::where('tagnumber', $request->tagnumber)->first();
        if ($check_tag) {
            ProcessHealthEdit::dispatch($request->vacation_date, $request->vaccine_name, $request->treatments, $request->treatments_date, $request->illness, $request->dose, $request->cost, $request->treated_by_vcn_number, $request->status, $request->tagnumber);
            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function productioncreate($request)
    {
        $production = Production::where("tagnumber", $request->tagnumber)->first();
        $check_tag = Animal_livestock::where('tag_id', $request->tagnumber)->first();
        if (!$production && $check_tag) {
            $animal = Animal::where('name', $check_tag->name)->first();

            ProcessProductionCreate::dispatch(
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
                $animal->animalid,
                $request->quantity
            );
            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function productionedit($request)
    {
        $production = Production::where("tagnumber", $request->tagnumber)->first();
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
                $request->quantity
            );
            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        } else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function financerecordcreate($request)
    {
        $finance = FinancialRecord::where('tagnumber', $request->tagnumber)->first();
        if (!$finance) {
            ProcessFinanceRecord::dispatch(
                $request->tagnumber,
                $request->production_type,
                $request->date_fin,
                $request->items,
                $request->input_cost,
                $request->yield,
                $request->current_value,
                $request->revenue,
                $request->profit
            );
            return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        }else {
            return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function financerecordedit($request){
        $finance = FinancialRecord::where('tagnumber', $request->tagnumber)->first();
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
        $request->profit
       );
       return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
       }
       else {
        return response()->json(['error' => 'please check your input'], 200);
    }
    }

    public function feeddelete($request){
       $feed = Feed::find($request->id);

       if($feed){
        $feed->delete();
        return response()->json(['success' => 'successful']);
       }else{
        return response()->json(['error' => 'please check your input'], 200);
       }
    }

    public function financedelete($request){
        $finance =  FinancialRecord::find($request->id);
    if($finance){
     $finance->delete();
     return response()->json(['success' => 'successful']);
    }else{
    return response()->json(['error' => 'please check your input'], 200);
    }
    }
}
