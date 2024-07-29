<?php

namespace App\Http\Controllers;

use App\Http\Resources\animalresource;
use App\Models\Animal;
use App\Models\FinancialRecord;
use App\Models\Production;
use App\Models\Species;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;
class GetController extends Controller
{


    public function totals(Request $request){

       $animal = count(Animal::all());
       $group =count(Species::select('speciesname')->distinct()->get());
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
      $arr = [];
      foreach ($monthlySums as $month => $sums) {
        $arr[] = [
            "month" => $month,
            "income" => $sums['income'],
            "expense" => $sums['expense']
        ];
    }

      return response()->json(["success"=>$arr]);
    }

    public function animaldata(){
          $animal =  Animal::orderBy('created_at', 'desc')->take(4)->get();
         $answer = animalresource::collection($animal)->resolve();
         return response()->json(["success"=>$answer]);
    }

    public function gender(){
        $animal = count(Animal::all());
        $male = count(Animal::where("sex", 'Male')->get())/$animal;
        $female = count(Animal::where("sex", 'Female')->get())/$animal;
        $percent = array($male, $female);
        return response()->json(['success'=>$percent]);
    }

    public function animaldatatable(Request $request){
        $animal =  Animal::orderBy('created_at', 'desc')->get();
       $answer = animalresource::collection($animal)->resolve();
       $ans = intval($request->get('number'));
       $pagdata =  $this->paginate($answer, 8, $ans);
       return response()->json(["success"=>$pagdata]);
  }


   public function test_api(){
    $client = new Client();
    $headers = [
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'client-id' => 'CLIENT_17212271759974Q9XG61BT3WQCR6S6WD4AWQZY4',
      'api-key' => 'y6brycnm2mso1mqlbbmc3cz4mjkf810jqem2661u'
    ];
    $request = new Req('GET', 'https://www.test-api.naitsng.com/api/integration/animal-table?page=1&limit=500', $headers);
    $res = $client->sendAsync($request)->wait();
    $body = $res->getBody()->getContents();
    $data = json_decode($body, true);
    $items =  $data['data']['data'];
    return response()->json($items);
    // foreach ($items as $item) {
    //     return response()->json($item);
    // }
   }
}
