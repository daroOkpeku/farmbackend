<?php

namespace App\Http\Controllers;

use App\Http\Resources\Animalresource;
use App\Models\Animal;
use App\Models\Animal_livestock;
use App\Models\Breed;
use App\Models\Farm;
use App\Models\Farmdetails;
use App\Models\FinancialRecord;
use App\Models\Livestock;
use App\Models\Production;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;
use Illuminate\Support\Facades\DB;

class GetController extends Controller
{


    public function totals(Request $request){
       $animal = count(Animal_livestock::all());
       $group =count(Breed::select('breedid')->distinct()->get());
       $producation = count(Production::all());
       $expanse = count(FinancialRecord::where("type_of_finance", "expense")->get());
       $arrtotals = array(
        ['total'=>$animal, "title"=>'Total Animal', "subtitle"=>"Animal"],
        ['total'=>$group, "title"=>'Total Groups', "subtitle"=>"Groups"],
        ["total"=>$producation, "title"=>'Total Production', "subtitle"=>"Production"],
        ["total"=>$expanse, "title"=>'Total Expense', "subtitle"=>"Expense"],
       );

       return response()->json(['success'=>$arrtotals]);
    }


    public function profile_and_loss(Request $request){
      $finances = FinancialRecord::all();
      $groupedFinances = $finances->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y-m'); // Group by year and month
    });
    $monthlySums = $groupedFinances->map(function($month) {
        $income = $month->where('type_of_finance', 'income')->sum('amount');
        $expense = $month->where('type_of_finance', 'expense')->sum('amount');
        return ['income' => $income, 'expense' => $expense];
    });
      $arr = array();
      foreach ($monthlySums as $month => $sums) {

        $arr[] = [
            "name" => $month,
            "profit" => $sums['income'],
            "expense" => $sums['expense'],
            "amt"=>$sums['date_of_finance']
        ];
    }

      return response()->json(["success"=>$arr]);
    }

    public function animaldata(){
        $animals = Animal_livestock::with('FarmConnect')->orderBy('created_at', 'desc')->take(8)->get();
      return  Animalresource::collection($animals)->additional(['success'=>true]);
    }

    public function gender(){
        $animal = count(Animal_livestock::all());
        $male = count(Animal_livestock::where("sex", 'Male')->get())/$animal * 100;
        $female = count(Animal_livestock::where("sex", 'Female')->get())/$animal * 100;
        $percent = array($male, $female);
        return response()->json(['success'=>$percent, 'total'=>$animal]);
    }

    public function animaldatatable(Request $request){
        $animals =  Animal_livestock::with('FarmConnect')->orderBy('created_at', 'desc')->paginate(8);
        return Animalresource::collection($animals)->additional(['success'=>true]);
     }

     public function farmnames(){
       $farmlist = Farm::orderBy('created_at', 'desc')->pluck('farmname');
       return response()->json(['success'=>$farmlist]);
     }

     public function breednames(){
        $breedlist = Breed::orderBy('created_at', 'desc')->pluck('breedname');
        return response()->json(['success'=>$breedlist]);
     }

   public function test_api(){
    // $client = new Client();
    // $headers = [
    //   'Content-Type' => 'application/json',
    //   'Accept' => 'application/json',
    //   'client-id' => 'CLIENT_17212271759974Q9XG61BT3WQCR6S6WD4AWQZY4',
    //   'api-key' => 'y6brycnm2mso1mqlbbmc3cz4mjkf810jqem2661u'
    // ];
    // $request = new Req('GET', 'https://www.test-api.naitsng.com/api/integration/animal-table?page=1&limit=500', $headers);
    // $res = $client->sendAsync($request)->wait();
    // $body = $res->getBody()->getContents();
    // $data = json_decode($body, true);
    // $items =  $data['data']['data'];
    // return response()->json($items);
    // // foreach ($items as $item) {
    // //     return response()->json($item);
    // // }

    $livestocks = Livestock::all();

    foreach($livestocks as $livestock){

     DB::table('animal_livestocks')->insert([
            'name'=>$livestock->livestock_type,
            'sex'=>$livestock->gender,
            'image'=>$livestock->verification_photo,
            'age'=>1,
            'breed'=>$livestock->livestock_breed,
            'weight'=>$livestock->weight,
            'tag_id'=>$livestock->tag_id,
            'health_status'=>$livestock->health_status,
            'farm_farmid'=>$livestock->owner_id,
            'created_at'=>now(),
            'updated_at'=>now()
            ]);
    }

   }
}
