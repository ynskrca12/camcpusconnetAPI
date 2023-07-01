<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AdvertController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('activities',[ActivityController::class,'index']);
Route::post('activities/create',[ActivityController::class,'store']);
Route::put('activities/edit{activity}',[ActivityController::class,'update']);
Route::delete('activities/{activity}',[ActivityController::class,'delete']);

Route::get('announcements',[AnnouncementController::class,'index']);
Route::post('announcement/create',[AnnouncementController::class,'store']);
Route::put('announcement/edit{announcement}',[AnnouncementController::class,'update']);
Route::delete('announcement/{announcement}',[AnnouncementController::class,'delete']);


Route::get('news',[NewsController::class,'index']);
Route::post('news/create',[NewsController::class,'store']);
Route::put('news/edit{news}',[NewsController::class,'update']);
Route::delete('news/{news}',[NewsController::class,'delete']);

Route::get('adverts',[AdvertController::class,'index']);
Route::post('adverts/create',[AdvertController::class,'store']);
Route::put('adverts/edit{activity}',[AdvertController::class,'update']);
Route::delete('adverts/{activity}',[AdvertController::class,'delete']);

Route::get('posts',[PostController::class,'index']);
Route::post('posts/create',[PostController::class,'store']);
Route::put('posts/edit{post}',[PostController::class,'update']);
Route::delete('posts/{post}',[PostController::class,'delete']);

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
});
