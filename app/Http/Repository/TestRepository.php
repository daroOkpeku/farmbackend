<?php

namespace App\Http\Repository;

use App\Http\Repository\Contracts\TestInterface;
use App\Jobs\ProcessHealthCreate;
use App\Jobs\ProcessHealthEdit;
use App\Models\Animal_livestock;
use App\Models\Animal;
use App\Models\HealthRecord;

class TestRepository implements TestInterface{

    public function info($request)
    {
        dd($request->all());
    }

    public function deleteAnimal($request){
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

    public function healthcreate($request){
        $check_tag = HealthRecord::where('tagnumber', $request->tagnumber)->first();
        if(!$check_tag){
         $animalId = optional(Animal::where('name', $check_tag->name)->first())->animalid;
        ProcessHealthCreate::dispatch($request->vacation_date, $request->vaccine_name, $request->treatments, $request->treatments_date, $request->illness, $request->dose, $request->cost, $request->treated_by_vcn_number, $request->status, $animalId, $request->tagnumber);
        return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        }else{
         return response()->json(['error' => 'please check your input'], 200);
        }
    }

    public function healthedit($request){
        $check_tag = HealthRecord::where('tagnumber', $request->tagnumber)->first();
        if($check_tag){
        ProcessHealthEdit::dispatch($request->vacation_date, $request->vaccine_name, $request->treatments, $request->treatments_date, $request->illness, $request->dose, $request->cost, $request->treated_by_vcn_number, $request->status, $request->tagnumber);
        return response()->json(['success' => 'successful', 'tagnumber' => $request->tagnumber], 200);
        }else{
         return response()->json(['error' => 'please check your input'], 200);
        }
    }


}
