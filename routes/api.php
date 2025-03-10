<?php

use App\Http\Controllers\EngineMetricsController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





Route::middleware('verify.api')->group(function () {
    Route::get("/hello", function(){
        return response()->json(["success"=>"hello how are you"]);
       });
    Route::controller(GetController::class)->group(function(){
        Route::get("/totals", "totals");
        Route::get("/profile_and_loss", "profile_and_loss");
        Route::get("/animaldata", "animaldata");
        Route::get("/gender", "gender");
        Route::get("/animaldatatable", "animaldatatable");
        Route::get("/test_api", "test_api");
        Route::get("/farmnames", "farmnames");
        Route::get("/breednames", "breednames");
        Route::get('/animaldetailsget', 'animaldetailsget');
        Route::get('/animalfeeddata', 'animalfeeddata');
        Route::get('/feeddetailsget', 'feeddetailsget');
        Route::get('/vaccinelist', 'vaccinelist');
        Route::get('/healthlist', 'healthlist');
        Route::get('/productionsingle', 'productionsingle');
        Route::get('/financialrecordsingle', 'financialrecordsingle');
        Route::get('/feed_mgt', 'feed_mgt');
        Route::get('/finance_list', 'finance_list');
        Route::get('/healthrecords_list', 'healthrecords_list');
        Route::get('/prouctionlist', 'prouctionlist');
        Route::get('/documentlist', 'documentlist');
        });
        
        Route::post("farminfo", [PostController::class, "farminfo"]);
        Route::post("/animaldetails", [PostController::class, "animaldetails"]);
        Route::post("/species", [PostController::class, "species"]);
        Route::post("/breed", [PostController::class, "breed"]);
        Route::post("/healthrecord", [PostController::class, "healthrecord"]);
        Route::post("/reproduction", [PostController::class, "reproduction"]);
        Route::post("/production", [PostController::class, "production"]);
        Route::post("/feed", [PostController::class, "feed"]);
        Route::post("/feedingschedule", [PostController::class, "feedingschedule"]);
        Route::post("/financialrecord", [PostController::class, "financialrecord"]);
        Route::post("/animallocation", [PostController::class, "animallocation"]);
        Route::post("/genealogy", [PostController::class, "genealogy"]);
        Route::post("/showtest", [PostController::class, "showtest"]);
        Route::post('/feedcreate', [PostController::class, "feedcreate"]);
        Route::controller(PostController::class)->group(function(){
            Route::delete('/deleteanimal/{id}', 'deleteAnimal')->where('id', '[0-9]+'); //done
            Route::put('/editanimaldetails', 'editanimaldetails');
            Route::put('/photo', 'photo');
            Route::put('/feededit', 'feededit');
            Route::post("/healthrecord_create", 'healthrecord_create');
            Route::put("/healthedit", "healthedit");
            Route::post('/productioncreate', 'productioncreate');
            Route::put('/productionedit', 'productionedit');
            Route::post('/financerecordcreate', 'financerecordcreate');
            Route::put('/financerecordedit', 'financerecordedit');
            Route::delete('/feeddelete/{id}', 'feeddelete')->where('id', '[0-9]+'); //done
            Route::delete('/financedelete/{id}', 'financedelete')->where('id', '[0-9]+'); //done
            Route::delete('/healthrecordsdelete/{id}', 'healthrecordsdelete')->where('id', '[0-9]+'); //done
            Route::delete('/productiondelete/{id}', 'productiondelete')->where('id', '[0-9]+');
            Route::post('/documentupload', 'documentupload');
            Route::delete('/documentdelete/{id}', 'documentdelete')->where('id', '[0-9]+');
        });
        

});



Route::controller(EngineMetricsController::class)->group(function(){
    Route::post('/engine-metrics/update', 'updatearduino');

});

//
