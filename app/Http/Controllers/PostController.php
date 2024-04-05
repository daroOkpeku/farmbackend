<?php
use App\Models\Farm;
namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Farmdetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

     public function farminfo(Request $request){
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

           $farmdetails =  Farmdetails::where(["farm_farmid"=>$farm->farmid])->first();
           if(!$farmdetails){
            Farmdetails::create([
             'farm_farmid'=>$farm->farmid,
                'phone'=>$request->phone,
                'email'=>$request->email,
               'website'=>$request->website,
              ]);
              return response()->json(['success'=>'successfully created'],200);
           }

       });
       return response()->json(['error'=>"please try again"],500);

     } catch (\Throwable $th) {
        return response()->json(['error'=>"something went wrong"],500);
     }

     }
}
