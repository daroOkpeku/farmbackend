<?php

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

Route::get("/hello", function(){
 return response()->json(["success"=>"hello how are you"]);
});

Route::controller(GetController::class)->group(function(){
Route::get("/totals", "totals");
Route::get("/profile_and_loss", "profile_and_loss");
Route::get("/animaldata", "animaldata");
Route::get("/gender", "gender");
Route::get("/animaldatatable", "animaldatatable");
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

