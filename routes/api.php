<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AdvertController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MessageController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('announcements',[AnnouncementController::class,'index']);
Route::post('announcement/create',[AnnouncementController::class,'store']);
Route::put('announcement/edit{announcement}',[AnnouncementController::class,'update']);
Route::delete('announcement/{announcement}',[AnnouncementController::class,'delete']);

Route::get('events',[EventController::class,'index']);
Route::post('events/create',[EventController::class,'store']);
Route::put('events/edit{event}',[EventController::class,'update']);
Route::delete('events/{event}',[EventController::class,'delete']);

Route::get('contacts',[ContactController::class,'index']);
Route::post('contacts/create',[ContactController::class,'store']);
Route::put('contacts/edit{contact}',[ContactController::class,'update']);
Route::delete('contacts/{contact}',[ContactController::class,'delete']);

Route::get('news',[NewsController::class,'index']);
Route::post('news/create',[NewsController::class,'store']);
Route::put('news/edit{news}',[NewsController::class,'update']);
Route::delete('news/{news}',[NewsController::class,'delete']);


Route::get('adverts',[AdvertController::class,'index']);
Route::post('adverts/create',[AdvertController::class,'store']);
Route::put('adverts/edit{advert}',[AdvertController::class,'update']);
Route::delete('adverts/{advert}',[AdvertController::class,'delete']);

Route::get('posts',[PostController::class,'index']);
Route::post('posts/create',[PostController::class,'store']);
Route::put('posts/edit{post}',[PostController::class,'update']);
Route::delete('posts/{post}',[PostController::class,'delete']);

Route::get('messages',[MessageController::class,'index']);
Route::post('messages/create',[MessageController::class,'store']);
Route::put('messages/edit{message}',[MessageController::class,'update']);
Route::delete('messages/{message}',[MessageController::class,'delete']);

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::get('/getusers',[UserController::class,'getAllUsers']);

Route::get('/user', function (Request $request) {
    return $request->user();
});
