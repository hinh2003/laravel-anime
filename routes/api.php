<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\v1\MoviesController ;
use App\Http\Controllers\Api\v1\SessionController ;
use App\Http\Controllers\Api\v1\BannerController ;
use App\Http\Controllers\Api\v1\ChapMoviesController;
use App\Http\Controllers\Api\v1\LoveMoviesController;
Route::post('/login', [SessionController::class, 'login']);
Route::post('/register', [SessionController::class, 'register']);
// list phim
Route::get('movies/list', [MoviesController::class, 'index']);
Route::get('movies/{slug}', [MoviesController::class, 'show']);
//list banner
Route::get('banner', [BannerController::class, 'index']);
//chap phim
Route::get('movies/chap/{id}', [ChapMoviesController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [SessionController::class, 'logout']);
    Route::get('/movies_love', [LoveMoviesController::class, 'index']);

});
