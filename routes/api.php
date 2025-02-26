<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\v1\MoviesController ;
use App\Http\Controllers\Api\v1\SessionController ;
use App\Http\Controllers\Api\v1\BannerController ;

Route::post('/login', [SessionController::class, 'login']);
Route::post('/register', [SessionController::class, 'register']);
// list phim
Route::get('movies/list', [MoviesController::class, 'index']);
Route::get('movies/{id}', [MoviesController::class, 'show']);
//list banner

Route::get('banner', [BannerController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [SessionController::class, 'logout']);


});
