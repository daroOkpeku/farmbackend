<?php

namespace App\Http\Controllers;

use App\Http\Repository\Contracts\TestInterface;
use App\Http\Requests\Arduinorequest;
use App\Models\Animal_livestock;
use App\Models\HealthRecord;
use Illuminate\Http\Request;

class EngineMetricsController extends Controller
{
    protected $testinterface;
    public function __construct(TestInterface $testInterface)
    {
        $this->testinterface = $testInterface;
    }


    public function updatearduino( Arduinorequest $request){
        $animal = Animal_livestock::where('tag_id', $request->tag_id)->first();
        if($request->api_key  != 'y6brycnm2mso1mqlbbmc3cz4mjkf810jqem2661u'){
          return response()->json(['error'=>'please enter the correct api key'],500); 
        }
        if($animal){
            $animal->update([
               'health_status'=> $request->health_status,
            ]);
            HealthRecord::where("tagnumber", $request->tag_id)
            ->orderBy("created_at", "desc")
            ->first()?->update([
                "status" => $request->health_status,
            ]);
          return $this->testinterface->updatearduino($request->tag_id, $request);
        }else{
          return response()->json(['error'=>'the animal tag id does not exist'],500);
        }
    }
}
