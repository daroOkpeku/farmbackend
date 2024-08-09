<?php

namespace App\Http\Controllers;

use App\Http\Resources\Animalresource;
use App\Models\Animal;
use App\Models\Animal_livestock;
use App\Models\Breed;
use App\Models\Document;
use App\Models\Farm;
use App\Models\Farmdetails;
use App\Models\Feed;
use App\Models\FinancialRecord;
use App\Models\HealthRecord;
use App\Models\Livestock;
use App\Models\Production;
use App\Models\Vaccines;
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
       $expanse = count(FinancialRecord::all());
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

    $arr = [];
    $monthlySums = $groupedFinances->map(function($month) use (&$arr) {


        // Iterate over each record in the month
        foreach ($month as $record) {
            $arr[] = [
                'month'=>Carbon::parse($record['created_at'])->format('Y-m'),
                'profit' => floatval($record['profit']),
                'loss' => floatval($record['input_cost']),
            ];
        }



        return null; // Return null to satisfy the map function, though it's not used
    });

    // Return the array as JSON response
    return response()->json(["success" => $arr]);
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

     public function animaldetailsget(Request $request){
     $animal = Animal_livestock::with('FarmConnect')->where(['tag_id'=>$request->get('tagnumber'), 'id'=>intval($request->get('id'))])->first();
     return response()->json(['success'=>$animal]);
     }

     public function feeddetailsget(Request $request){
      $feed =  Feed::with('feedConnection')->where(['tagnumber'=>$request->get('tagnumber'), 'id'=>intval($request->get('id'))])->first();
      return response()->json(['success'=>$feed]);
     }

     public function vaccinelist(){
      $vaccines = Vaccines::orderBy('created_at', 'desc')->pluck('vaccine_name');
      return response()->json(['success'=>$vaccines]);
     }

     public function healthlist(Request $request){
        // HealthRecord
        $health = HealthRecord::where(['tagnumber'=>$request->get('tagnumber'), 'id'=>intval($request->get('id'))])->first();
        return response()->json(['success'=>$health]);
     }

     public function productionsingle(Request $request){
       $production = Production::where(['tagnumber'=>$request->get('tagnumber'), 'id'=>intval($request->get('id'))])->first();
       return response()->json(['success'=>$production]);
     }

     public function financialrecordsingle(Request $request){
     $finance =  FinancialRecord::where(['tagnumber'=>$request->get('tagnumber'), 'id'=>intval($request->get('id'))])->first();
     return response()->json(['success'=>$finance]);
     }

     public function feed_mgt(Request $request){
        $feed = Feed::with('feedMgt')->orderBy('created_at', 'desc')->paginate(8);
        return response()->json(['success'=>$feed]);
     }

     public function finance_list(){
         $finance =  FinancialRecord::with('financeConnect')->orderBy('created_at', 'desc')->paginate(8);
     return response()->json(['success'=>$finance]);
     }

     public function healthrecords_list(){
        $healthrecords = HealthRecord::with('healthConnect')->orderBy('created_at', 'desc')->paginate(8);
        return response()->json(['success'=>$healthrecords]);
     }

     public function prouctionlist(Request $request){
        $feed = Production::whereNotNull('tagnumber')->with('producconnect')->orderBy('created_at', 'desc')->paginate(8);
        return response()->json(['success'=>$feed]);
     }

     public function documentlist(){
       $document = Document::orderBy('created_at', 'desc')->paginate(8);
       return response()->json(['success'=>$document]);
     }



     public function animalfeeddata(){


        $animal_feed = [

               [
                [
                    "animal_name" => "Cattle",
                    "feed_name" => "Hay",
                    "quantity_kg" => 50,  // Quantity in kg
                    "cost_naira" => 5000,  // Cost in Nigerian Naira
                    'feed_type'=>array(
                        'Succulent Roughage',
                        'Dry Roughage',
                        'Concentrate',
                        'Energy Feed',
                        'Protein Supplement',
                        'Pasture',
                        'Tropical Grasses',
                        'Hay',
                        'Legumes'
                    ),
                ],

                [
                    "animal_name" => "Sheep",
                    "feed_name" => "Hay",
                    "quantity_kg" => 100,  // Quantity in kg
                    "cost_naira" => 9500,  // Cost in Nigerian Naira
                   'feed_type'=>array(
                        'Succulent Roughage',
                        'Dry Roughage',
                        'Concentrate',
                        'Energy Feed',
                        'Protein Supplement',
                        'Pasture',
                        'Tropical Grasses',
                        'Hay',
                        'Legumes'
                    ),
                ],
                [
                    "animal_name" => "Goat",
                    "feed_name" => "Hay",
                    "quantity_kg" => 200,  // Quantity in kg
                    "cost_naira" => 18000,  // Cost in Nigerian Naira
                    'feed_type'=>array(
                        'Succulent Roughage',
                        'Dry Roughage',
                        'Concentrate',
                        'Energy Feed',
                        'Protein Supplement',
                        'Pasture',
                        'Tropical Grasses',
                        'Hay',
                        'Legumes'
                    ),
                ]
                // [
                //     "animal_name" => "Cattle",
                //     "feed_name" => "Hay",
                //     "quantity_kg" => 100,  // Quantity in kg
                //     "cost_naira" => 9500,  // Cost in Nigerian Naira
                //     'type'=>'Roughages'
                // ],
                // [
                //     "animal_name" => "Cattle",
                //     "feed_name" => "Hay",
                //     "quantity_kg" => 200,  // Quantity in kg
                //     "cost_naira" => 18000,  // Cost in Nigerian Naira
                //     'type'=>'Roughages'
                // ]
                ],
            //     [
            //    [
            //         "animal_name" => "Pig",
            //         "feed_name" => "Pig Feed",
            //         "quantity_kg" => 30,  // Quantity in kg
            //         "cost_naira" => 3000  // Cost in Nigerian Naira
            //    ],
            //    [
            //         "animal_name" => "Pig",
            //         "feed_name" => "Pig Feed",
            //         "quantity_kg" => 60,  // Quantity in kg
            //         "cost_naira" => 5800  // Cost in Nigerian Naira
            //    ],
            //     [
            //         "animal_name" => "Pig",
            //         "feed_name" => "Pig Feed",
            //         "quantity_kg" => 120,  // Quantity in kg
            //         "cost_naira" => 11000  // Cost in Nigerian Naira
            //     ]
            //     ],
            //    [
            //     [
            //         "animal_name" => "Goat",
            //         "feed_name" => "Grass",
            //         "quantity_kg" => 20,  // Quantity in kg
            //         "cost_naira" => 2000  // Cost in Nigerian Naira
            //     ],
            //    [
            //         "animal_name" => "Goat",
            //         "feed_name" => "Grass",
            //         "quantity_kg" => 40,  // Quantity in kg
            //         "cost_naira" => 3800  // Cost in Nigerian Naira
            //    ],
            //    [
            //         "animal_name" => "Goat",
            //         "feed_name" => "Grass",
            //         "quantity_kg" => 80,  // Quantity in kg
            //         "cost_naira" => 7400  // Cost in Nigerian Naira
            //    ]
            //     ],
            //    [
            //   [
            //         "animal_name" => "Sheep",
            //         "feed_name" => "Sheep Feed",
            //         "quantity_kg" => 25,  // Quantity in kg
            //         "cost_naira" => 2500  // Cost in Nigerian Naira
            //   ],
            //     [
            //         "animal_name" => "Sheep",
            //         "feed_name" => "Sheep Feed",
            //         "quantity_kg" => 50,  // Quantity in kg
            //         "cost_naira" => 4800  // Cost in Nigerian Naira
            //     ],
            //    [
            //         "animal_name" => "Sheep",
            //         "feed_name" => "Sheep Feed",
            //         "quantity_kg" => 100,  // Quantity in kg
            //         "cost_naira" => 9200  // Cost in Nigerian Naira
            //    ]
            // ]
               ];


        return response()->json(['success'=>$animal_feed]);
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

    // foreach($livestocks as $livestock){

    //  DB::table('animal_livestocks')->insert([
    //         'name'=>$livestock->livestock_type,
    //         'sex'=>$livestock->gender,
    //         'image'=>$livestock->verification_photo,
    //         'age'=>1,
    //         'breed'=>$livestock->livestock_breed,
    //         'weight'=>$livestock->weight,
    //         'tag_id'=>$livestock->tag_id,
    //         'health_status'=>$livestock->health_status,
    //         'farm_farmid'=>$livestock->owner_id,
    //         'created_at'=>now(),
    //         'updated_at'=>now()
    //         ]);
    // }
//     foreach($livestocks as $livestock){
//         $random_number = rand(0, 10000);
//        $animal = Animal::where('name', $livestock->livestock_type)->first();
//     DB::table('productions')->insert([
//         'productionid'=>$random_number,
//         'animal_animalid'=>$animal->animalid,
//         'date_of_producation'=>$livestock->gestation_date,
//         'production_type'=>$livestock->production_type,
//            'quantity'=>0,
//           'weight'=>$livestock->weight,
//           'created_at'=>now(),
//         'updated_at'=>now()
//     ]);
// }





   }
}
