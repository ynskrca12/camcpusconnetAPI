<?php

use App\Http\Controllers\Api\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('activities',[ActivityController::class,'index']);
Route::post('activities/create',[ActivityController::class,'store']);
Route::put('activities/edit{activity}',[ActivityController::class,'update']);
Route::delete('activities/{activity}',[ActivityController::class,'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
