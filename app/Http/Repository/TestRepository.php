<?php

namespace App\Http\Repository;

use App\Http\Repository\Contracts\TestInterface;
use App\Models\Animal;

class TestRepository implements TestInterface{

    public function info($request)
    {
        dd($request->all());
    }

    public function deleteAnimal($request){
    try {
        $animal = Animal::findOrFail($request->id);
        // $animal->delete();
        return response()->json(['success' => 'Animal deleted successfully', 'test'=>$animal], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['message' => 'Animal not found'], 404);
    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred while trying to delete the animal'], 500);
    }
    }
}
