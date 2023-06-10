<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AdvertController;
use App\Http\Controllers\Api\UniversityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('activities',[ActivityController::class,'index']);
Route::post('activities/create',[ActivityController::class,'store']);
Route::put('activities/edit{activity}',[ActivityController::class,'update']);
Route::delete('activities/{activity}',[ActivityController::class,'delete']);


Route::get('adverts',[AdvertController::class,'index']);
Route::post('adverts/create',[AdvertController::class,'store']);
Route::put('adverts/edit{activity}',[AdvertController::class,'update']);
Route::delete('adverts/{activity}',[AdvertController::class,'delete']);

Route::get('universities',[UniversityController::class,'index']);
Route::post('universities/create',[UniversityController::class,'store']);
Route::put('universities/edit{activity}',[UniversityController::class,'update']);
Route::delete('universities/{activity}',[UniversityController::class,'delete']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
