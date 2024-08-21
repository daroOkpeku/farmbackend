<?php

namespace App\Http\Controllers;

use App\Http\Repository\Contracts\TestInterface;
use App\Http\Requests\Arduinorequest;
use App\Models\Animal_livestock;
use Illuminate\Http\Request;

class EngineMetricsController extends Controller
{
    protected $testinterface;
    public function __construct(TestInterface $testInterface)
    {
        $this->testinterface = $testInterface;
    }


    public function updatearduino($id, Arduinorequest $request){
        $animal = Animal_livestock::where('tag_id', $id)->first();
        if($animal){
          return $this->testinterface->updatearduino($id, $request);
        }else{
          return response()->json(['error'=>'the animal tag id does not exist'],500);
        }
    }
}
