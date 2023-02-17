<?php

use App\Domains\Auth\Http\Controllers\Frontend\Auth\LoginController;
use App\Domains\GameConsign\Http\Controllers\GameConsignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [LoginController::class,'loginAPI']);

// PUBLIC SERVICES
Route::group(["prefix" => "public"], function() {
    Route::post("/anagrams",[GameConsignController::class,"Anagrams"]);
    Route::post("/nparam/{n}",[GameConsignController::class,"Nparam"]);
    Route::get("/marvel",[GameConsignController::class,"getMarvelCharacters"]);
    Route::get("/marvel/{perPage}",[GameConsignController::class,"getMarvelCharactersWithPagination"]);
    Route::get("/swapi/paginate",[GameConsignController::class,"getStarwarsCharactersWithPagination"]);
});

//PRIVATE SERVICES
Route::middleware(['auth:api'])->group(function () {
    Route::group(["prefix" => "private"], function() {
        Route::get("/marvel",[GameConsignController::class,"getMarvelCharactersAuth"]);
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
// });